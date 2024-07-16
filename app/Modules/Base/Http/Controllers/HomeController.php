<?php

namespace App\Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Lag\Models\Recording;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();
        $hour = date('H');

        $meetings = $user->meetings()->running()->get();

        $recordings = Recording::all();

        return view('base::home', [
            'hour' => $hour,
            'user' => $user,
            'meetings' => $meetings,
            'recordings' => $recordings,
        ]);
    }
}
