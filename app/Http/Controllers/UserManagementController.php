<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\NewUser;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LoginValidator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserManagementController
 *
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class UserManagementController extends Controller
{
    /**
     * UserManagementController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lang');
    }

    /**
     * [BACK-END]: backend user management overview.
     *
     * @url:platform  GET|HEAD: /backend/users
     * @see:phpunit   UserManagementTest::testOverview()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function overview()
    {
		$data['users'] = User::paginate(15);
        return view('users.index', $data);
    }

    /**
     * [BACK-END] Backend view for creating a new user.
     *
     * @url:platform  GET|HEAD: backend/users/create
     * @see:phpunit   UserManagementTest::testCreateViewBackend()
	 *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Reset the password for a specific user.
     *
     * @url:platform  GET|HEAD: /backend/users/reset/{id}
     * @see:phpunit   UserManagementTest::testUserPasswordReset()
     *
     * @param  int $id The user id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->password =  bcrypt(str_random(16));

        if ($user->save()) // If the user has been updated;
        {
            session()->flash('class', 'alert alert-danger');
            session()->flash('message', trans('flash-session.user-reset'));
        }

        return redirect()->back(302);
    }

    /**
     * Show the details for a specific user.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit
     *
     * @param  int $id The user id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $data['user'] = User::findOrFail($id);
        return view('', $data);
    }

    /**
     * [METHOD]: Search for a specific user.
     *
     * @url:platform  POST: /backend/users/search
     * @see:phpunit   UserManagementTest::testSearchBackend()
     *
     * @param  Request $input
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $input)
    {
        $term = $input->get('term');

        $data['users'] = User::where('name', 'LIKE', "%$term%")->get();
        return view('users.index', $data);
    }

    /**
     * [METHOD]: Insert a new login into the database.
     *
     * @url:platform  POST: /backend/users
     * @see:phpunit   UserManagementTest::testCreateMethodWithoutErrors()
     * @see:phpunit   UserManagementTest::testCreateMethodWithError()
     *
     * @param LoginValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginValidator $input)
    {
        $db['password'] = bcrypt(str_random(16));
        $db['theme']    = 'skin-red';

        $data     = array_merge($db, $input->except('_token'));
        $newUser  = User::create($data);

        $findNewUser = User::find($newUser->id);
        $setStatus     = $findNewUser->givePermissionTo('active');

        if ($newUser && $setStatus) {
            Mail::to($findNewUser->email)->send(new NewUser($findNewUser));

            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.user-store'));
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Delete a user out off the system.
     *
     * @url:platform  GET|HEAD: /backend/users/destroy/{id}
     * @see:phpunit   UserManagementTest::testDeleteMethod()
     *
     * @param  int $id the login id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
		if (User::destroy($id)) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.user-destroy'));
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: block a user login
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   UserManagementTest::
     *
     * @param  int $id the login id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->revokePermissionTo('active');
        $user->givePermissionTo('blocked');

        // Delete session if user is authencated.
        DB::table('sessions')->where('user_id', $id)->delete();

		session()->flash('class', 'alert alert-success');
		session()->flash('message', trans('flash-session.user-block'));

        return redirect()->back();
    }

    /**
     * [METHOD]: Unblock a user login.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit
     *
     * @param  int $id the login id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblock($id)
    {
        $user = User::findOrFail($id);
        $user->revokePermissionTo('blocked');
        $user->givePermissionTo('active');

		session()->flash('class', 'alert alert-success');
		session()->flash('message', trans('flash-session.user-unblock'));

        return redirect()->back();
    }
}
