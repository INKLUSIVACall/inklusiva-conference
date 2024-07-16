<?php

namespace App\Http\Middleware;

use Caffeinated\Modules\Facades\Module;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Menu;

class MenuMiddleware {

    /**
     * Build Lavary Menustructure from array.
     *
     * @param $menuArray
     * @param $menuItem
     */
    private function buildMenu($menuArray, $menuItem) {
        foreach ($menuArray as $key => $value) {

            if ($this->hasPermission($value)) {
                $parent = $menuItem->add($key, $value['attributes']);
                if (isset($value['data'])) {
                    foreach ($value['data'] as $kd => $vd) {
                        if (is_array($vd)) {
                            $vd = array_pop($vd);
                        }
                        $parent->data($kd, $vd);
                    }
                }

                if (isset($value['active'])) {
                    foreach ($value['active'] as $v) {
                        $parent->active($v);
                    }
                }
                if (isset($value['children'])) {
                    $this->buildMenu($value['children'], $parent);
                }
            }
        }
    }

    /**
     * Checks whether User is permitted to show the Menuitem.
     *
     * @param $values
     * @return bool
     */
    private function hasPermission($values) {
        if (isset($values['attributes']['route'])) {
            $routeName = $values['attributes']['route'];
            if (is_array($routeName)) {
                $routeName = $routeName[0];
            }

            $middleWare = (array) Route::getRoutes()->getByName($routeName)->getAction()['middleware'];
            $perms = [];
            $roles = [];
            $auth = false;
            foreach ($middleWare as $m) {
                if ($m == 'auth') {
                    $auth = true;
                }
                $parts = explode(':', $m);
                if ($parts[0] == 'permission') {
                    $perms[] = $parts[1];
                }
                if ($parts[0] == 'role') {
                    if (strpos($parts[1],'|')!==false) {
                        $roles = explode('|', $parts[1]);
                    } else {
                        $roles[] = $parts[1];
                    }
                }
            }

            if ($auth == false) {
                return true;
            }
            if (count($perms) > 0 || count($roles) > 0) {
                if (Auth::user()) {
                    // allowance is the return value.
                    $allowance = false;
                    // allowance is only true, if the active user has any of the needed roles...
                    $allowance = Auth::user()->hasAnyRole($roles);
                    // ...or any of the needed Permissions.
                    foreach($perms as $permsElement) {
                        // Permissions can either be supplied as an Array or a String with '|' as delimiter (or a mixture of both).
                        // therefore we need to check every element of the array, whether it needs to be exploded further.
                        $permsElement = explode("|", $permsElement);

                        foreach($permsElement as $perm) {
                            if(Auth::user()->hasPermissionTo($perm)){
                                $allowance = true;
                            }
                        }
                    }
                    return $allowance;
                    //return Auth::user()->ability($roles, $perms);
                } else {
                    return false;
                }
            } else {
                if(Auth::user()) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    /**
     * Preparing the menu, based on the menu configuration of all
     * enabled modules
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        // Read menu array from enabled modules
        $modules = Module::all();
        $menuArray = [];

        foreach ($modules as $module) {
            if ($module['enabled'] == true) {
                $menuFile = app_path('Modules') . '/' . ucfirst($module['slug']) . '/menu.php';;
                if (file_exists($menuFile)) {
                    $menuArray = array_merge_recursive($menuArray, require_once($menuFile));
                }
            }
        }

        // Traverse first level, which is the menu itself
        foreach ($menuArray as $key => $value) {
            $menu = Menu::make($key, function (){});
            // recursively build Menu-structure
            $this->buildMenu($value, $menu);
        }

        return $next($request);
    }
}
