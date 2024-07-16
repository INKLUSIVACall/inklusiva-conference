<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect('/login');
}
);

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/rendermessage', [
        'as' => 'base.rendermessage',
        'uses' => "App\Http\Controllers\Controller@renderMessage",
    ]);
});

/*
Route::get('/getunusedlangkeys', function () {
    $viewPath = [
        base_path('resources/views'),
        app_path(),
    ];

    // get all lang files and keys
    $langFiles = File::allFiles(base_path('lang'));

    $langKeys = [];
    foreach ($langFiles as $langFile) {
        $f = require $langFile->getPathname();
        if (is_array($f)) {
            $langKeys[$langFile->getRelativePathname()] = array_keys($f);
        }
    }

    $langKeysOriginal = $langKeys;

    // iterate over all view files
    foreach ($viewPath as $path) {
        $files = File::allFiles($path);
        foreach ($files as $file) {
            $content = file_get_contents($file->getPathname());

            // iterate over all lang keys
            // if a lang key is found in the content, remove it from the lang keys
            foreach ($langKeysOriginal as $langFile => $keys) {
                foreach ($keys as $key) {
                    if (strpos($content, $key) !== false) {
                        unset($langKeys[$langFile][array_search($key, $langKeys[$langFile])]);
                    }
                }
            }
        }
    }

    dd($langKeys, $langKeysOriginal);

    return response()->json($unusedLangKeys);
});
 */
