<?php

namespace App\Modules\Useradmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
/**
     * Show the profile page for the current user.
     */
    public function index()
    {
        $user = Auth::user();
        return view('useradmin::profile.index', ['user' => $user]);
    }

    /**
     * Show the access data page for the current user.
     */
    public function accessDataIndex()
    {
        $user = Auth::user();
        return view('useradmin::profile.accessdata', ['user' => $user]);
    }

    /**
     * Show a page where the user can update its profile data.
     */
    public function editData()
    {
        $user = Auth::user();
        return view('useradmin::profile.edit-data', ['user' => $user]);
    }

    /**
     * Actually Update the profile data for the current user.
     */
    public function updateData(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->occupation = $request->occupation;
        $user->organisation_name = $request->organisation_name;

        $user->save();

        return Redirect::route('useradmin.profile.index')->with('success', __('backend/personaldata.index.updateData.successful'));
    }

    /**
     * Show a page where the user can update its email-adress.
     */
    public function editEmail()
    {
        $user = Auth::user();
        return view('useradmin::profile.edit-email', ['user' => $user]);
    }

    /**
     * Actually Update the email-adress for the current user.
     */
    public function updateEmail()
    {
        $user = Auth::user();

        $validated = request()->validate([
            'email' => 'required|email:rfc,dns|unique:users,email,' . $user->id,
            'emailconfirm' => 'required|same:email'
        ],
        [
            'email.required' => __('backend/personaldata.updateEmail.error.email.required'),
            'email.unique' => __('backend/personaldata.updateEmail.error.email.unique'),
            'email.email' => __('backend/personaldata.updateEmail.error.email.email'),
            'emailconfirm.required' => __('backend/personaldata.updateEmail.error.emailconfirm.required'),
            'emailconfirm.same' => __('backend/personaldata.updateEmail.error.emailconfirm.same'),
        ]);

        $user->new_email = $validated['email'];
        $new_email_pin = rand(100000, 999999);
        $user->new_email_pin = $new_email_pin;
        $user->save();

        $user->sendEmailUpdatePinNotification($new_email_pin);

        return Redirect::route('useradmin.profile.accessDataIndex')->with('success', __('backend/personaldata.updateEmail.success'));
    }

    public function confirmEmail()
    {
        $user = Auth::user();

        return view('useradmin::profile.confirm-email', ['user' => $user]);
    }

    public function switchEmail(Request $request)
    {
        $user = Auth::user();

        $validated = request()->validate([
            'pin' => 'required | numeric',
        ],
        [
            'pin.required' => __('backend/personaldata.confirmEmail.error.pin.required'),
            'pin.numeric' => __('backend/personaldata.confirmEmail.error.pin.numeric'),
        ]);

        // check if the pin is correct.
        if($validated['pin'] != $user->new_email_pin) {
            return Redirect::route('useradmin.profile.confirmEmail')->withErrors(__('backend/personaldata.confirmEmail.error.wrongPin'));
        }

        $user->email = $user->new_email;
        $user->new_email = null;
        $user->new_email_pin = null;
        $user->save();

        return Redirect::route('useradmin.profile.accessDataIndex')->with('success', __('backend/personaldata.confirmEmail.success'));
    }

    public function sendPinAgain()
    {
        $user = Auth::user();

        $user->sendEmailUpdatePinNotification($user->new_email_pin);

        return Redirect::route('useradmin.profile.confirmEmail')->with('success', __('backend/personaldata.confirmEmail.resendPin.success'));
    }

    /**
     * Show a page where the user can update its password.
     */
    public function editPassword()
    {
        $user = Auth::user();
        return view('useradmin::profile.edit-password', ['user' => $user]);
    }

    /**
     * Actually Update the password for the current user.
     */
    public function updatePassword()
    {
        $user = Auth::user();

        $validated = request()->validate([
            'current_password' => 'required | current_password',
            'new_password' => 'required | confirmed',
            'new_password_confirmation' => 'required'
        ],[
            'current_password.required' => __('backend/personaldata.updatePassword.error.current_password.required'),
            'current_password.current_password' => __('backend/personaldata.updatePassword.error.current_password.current_password'),
            'new_password.required' => __('backend/personaldata.updatePassword.error.new_password.required'),
            'new_password.confirmed' => __('backend/personaldata.updatePassword.error.new_password.confirmed'),
            'new_password_confirmation.required' => __('backend/personaldata.updatePassword.error.new_password_confirmation.required'),
        ]
    );

        $user->password = Hash::make($validated['new_password']);
        $user->save();

        return Redirect::route('useradmin.profile.accessDataIndex')->with('success', __('backend/personaldata.updatePassword.success'));
    }
}
