<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     *
     */
    public function testUpdateInformation()
    {

    }

    /**
     * POST:  settings/profile/security
     * ROUTE: settings.profile.password.post
     *
     * @group auth
     * @group profile
     * @group all
     * @group backend
     */
    public function testUpdatePassword()
    {
        $input['password']              = 'password';
        $input['password_confirmation'] = 'password';

        $session['class']   = 'alert alert-success';
        $session['message'] = trans('auth.FlashSec');

        $this->authentication();
        $this->post(route('settings.profile.password.post'), $input);
        $this->dontSeeInDatabase('users', ['password' => $this->user->password]);
        $this->session($session);
        $this->seeStatusCode(302);
    }

    /**
     * GET|HEAD: /settings/profile
     * ROUTE:    settings.profile
     * 
     * @group auth
     * @group profile
     * @group all
     * @group backend
     */
    public function testUpdateView()
    {
        $route = route('settings.profile');

        $this->authentication();
        $this->get($route);
        $this->seeStatusCode(200);
    }
}
