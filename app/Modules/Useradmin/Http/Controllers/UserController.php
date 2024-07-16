<?php

namespace App\Modules\Useradmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Show the Index Page for Users containing a list of all users.
     */
    public function index()
    {
        // return all users.
        $users = User::all();

        return view('useradmin::user.index', [
            'users' => $users,
            'success' => Session::get('success'),
        ]);
    }

    /**
     * Show the Create Page for Users containing a form to create a new user.
     */
    public function create()
    {
        return view('useradmin::user.create', ['roles' => Role::all()]);
    }

    /**
     * Store a new user in the database.
     */
    public function store()
    {
        // validate the request.
        $validated = request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'occupation' => 'required',
            'organisation_name' => 'nullable',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'roles' => 'nullable',
        ], [
            'firstname.required' => __('backend/user.create.firstname.required'),
            'lastname.required' => __('backend/user.create.lastname.required'),
            'occupation.required' => __('backend/user.create.occupation.required'),
            'email.required' => __('backend/user.create.email.required'),
            'email.email' => __('backend/user.create.email.email'),
            'email.unique' => __('backend/user.create.email.unique'),
            'password.required' => __('backend/user.create.password.required'),
        ]);

        $validated['name'] = $validated['firstname'].' '.$validated['lastname'];

        // create a new user.
        $user = User::create($validated);

        // assign all choosen roles to the user.
        if (isset($validated['roles'])) {
            $user->assignRole($validated['roles']);
        }
        if (request()->password != null) {
            $user->password = bcrypt(request()->password);
        }

        $user->save();

        // redirect to the index page for users.
        return Redirect::route('useradmin.user.index')->with('success', __('backend/user.create.success'));
    }

    public function edit()
    {
        // find the user.
        $user = User::findOrFail(request()->id);

        return view('useradmin::user.edit', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function update($id)
    {
        // validate the request.
        $validated = request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'occupation' => 'required',
            'organisation_name' => 'nullable',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'nullable',
            'is_active' => 'nullable',
            'password' => 'nullable',
        ], [
            'firstname.required' => __('backend/user.create.firstname.required'),
            'lastname.required' => __('backend/user.create.lastname.required'),
            'occupation.required' => __('backend/user.create.occupation.required'),
            'email.required' => __('backend/user.create.email.required'),
            'email.email' => __('backend/user.create.email.email'),
            'email.unique' => __('backend/user.create.email.unique'),
        ]);

        if (request()->password == null) {
            unset($validated['password']);
        }

        // find the user.
        $user = User::findOrFail($id);

        $validated['name'] = $validated['firstname'].' '.$validated['lastname'];

        // update the user.
        $user->fill($validated);
        if (request()->password != null) {
            $user->password = bcrypt(request()->password);
        }
        $user->save();

        if (isset($validated['roles'])) {
            // if roles are selected, set the users role to exact these (dont add them, so that we can simultaneously add und remove them).
            $user->syncRoles($validated['roles']);
        } else {
            // if no roles are selected, set the users roles to none.
            $user->syncRoles([]);
        }

        $user->save();

        // if the user is not active, but the checkbox is checked, activate the user.
        if (isset($validated['is_active']) && $user['activated_at'] == null) {
            $this->activate(request(), $user, false);
        }

        // redirect to the index page for users.
        return Redirect::route('useradmin.user.index')->with('success', __('backend/user.update.success'));
    }

    /**
     * Display a confirmation modal for deleting a user.
     */
    public function confirmdestroy()
    {
        $user = User::findOrFail(request()->id);

        return view('useradmin::user.destroy', ['user' => $user]);
    }

    /**
     * Delete a user from the database.
     */
    public function destroy($id)
    {
        // find the user.
        $user = User::findOrFail($id);
        // delete the user.
        $user->delete();

        // redirect to the index page for users.
        return Redirect::route('useradmin.user.index')->with('success', __('backend/user.delete.success'));
    }

    /**
     * Returns the view for the not verified page.
     * e.g. User tries to login but is not activated yet.
     */
    public function notVerified()
    {
        return view('auth.verify');
    }

    /**
     * Display a confirmation modal for deleting a user.
     */
    public function confirmActivation(User $user)
    {
        return view('useradmin::user.activate', ['user' => $user]);
    }

    /**
     * Activate a user and send him a mail where he can set his password.
     */
    public function activate(Request $request, User $user, $redirect = true)
    {
        $addOrganisatorRole = $request->has('activate_organisator');

        // Activate the user.
        $user->activated_at = now();
        $user->save();

        if ($addOrganisatorRole) {
            $user->assignRole('Organisator');
        }

        // send activation mail
        $token = app(PasswordBroker::class)->createToken($user);
        $user->sendAccountActivatedNotification($token);

        if ($redirect) {
            return Redirect::route('useradmin.user.index')->with('success', __('backend/user.activate.success'));
        }
    }
}
