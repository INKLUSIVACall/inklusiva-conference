<?php

namespace App\Modules\Lag\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\Barrier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class SitemapController extends Controller
{
    public function index()
    {
        $menuUser = require base_path('app/Modules/Useradmin/menu.php');
        $menuLag = require base_path('app/Modules/Lag/menu.php');
        $menus = array_merge_recursive($menuUser, $menuLag);
        return view('lag::sitemap.index', ['menus' => $menus]);
    }

}
