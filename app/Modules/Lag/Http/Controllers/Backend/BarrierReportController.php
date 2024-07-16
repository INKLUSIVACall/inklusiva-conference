<?php

namespace App\Modules\Lag\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\Barrier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class BarrierReportController extends Controller
{
    public function index()
    {
        return view('lag::barrier.index', []);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barriereemail' => 'required|email',
            'barrieretext' => 'required',
        ], [
            'barriereemail.required' => 'Bitte geben Sie eine E-Mail-Adresse an.',
            'barriereemail.email' => 'Bitte geben Sie eine E-Mail-Adresse an.',
            'barrieretext.required' => 'Bitte geben Sie einen Text ein.',
        ]);

        if ($validator->fails()) {
            return view('lag::barrier.index', ['errors' => $validator->errors()]);
        } else {

            if (env('FILTER_4MORGEN_ADMINS', true)) {
                $adminUsers = User::role('admin')->where('email', 'not like', '%viermorgen%')->get();
            } else {
                $adminUsers = User::role('admin')->get();
            }
            foreach ($adminUsers as $adminUser) {
                Mail::to($adminUser->email)->send(new Barrier($request->barriereemail, $request->barrieretext, URL::current()));
            }
            return view('lag::barrier.index', ['success' => __('barrier.success')]);
        }
    }
}
