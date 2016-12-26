<?php

namespace App\Http\Controllers\auth;

use App\User;
use App\Themes;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileInfoValidator;
use App\Http\Requests\SecurityInfoValidator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * Class AccountController
 *
 * @package   App\Http\Controllers\auth
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class AccountController extends Controller
{
    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('lang');
    }

    /**
     * [BACK-END]: Get the profile view.
     *
     * @url:platform  GET|HEAD: settings/profile
     * @see:phpunit   AccountTest::testUpdateView()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $userId         = auth()->user()->id;
        $data['themes'] = Themes::all();
        $data['user']   = User::find($userId);

        return view('auth.profile', $data);
    }

    /**
     * [BACK-END]: Update the profile information.
     *
     * @url:platform  POST: /settings/profile
     * @see:phpunit   AccountTest::testUpdateInformation()
     *
     * @param  ProfileInfoValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfo(ProfileInfoValidator $input)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);

        if ($user->update($input->except(['avatar', '_token']))) // Check if we can do the update
        {
            if ($input->hasFile('avatar')) // The user want a new avatar.
            {
                $avatar = public_path(auth()->user()->avatar);

                if (file_exists($avatar)) // Check if the file exists on the server. If true delete this file.
                {
                    File::delete($avatar);
                }

                $image = $input->file('avatar');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('assets/avatars/' . $filename);

                // For windows servers.
                // Image::make($image->getLinkTarget())->resize(160, 160)->save($path);

                // For linux based servers.
                Image::make($image->getRealPath())->resize(160, 160)->save($path);

                // Save the avatar path to the database.
                $user->avatar = 'assets/avatars/' . $filename;
                $user->save();
            }

            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('auth.FlashInfo'));
        }

        return redirect()->back();
    }


    /**
     * [BACK-END]: Update the security settings for the account.
     *
     * @url:platform  POST: /settings/profile/security
     * @see:phpunit   AccountTest::testUpdateSecurity()
     *
     * @param  SecurityInfoValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSecurity(SecurityInfoValidator $input)
    {
        $userId  = auth()->user()->id;
        $filters = ['_token', 'password_confirmation'];

        if (User::find($userId)->update($input->except($filters))) // Check if we can do the update
        {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('auth.FlashSec'));
        }

        return redirect()->back();
    }
}
