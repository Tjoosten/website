<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class UserManagementTest
 */
class UserManagementTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD:  /backend/users
     * ROUTE: users.index
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testOverview()
    {
        $this->authentication();
        $this->get(route('users.index'));
        $this->see('Overzicht.');
        $this->seeStatusCode(200);
    }

    /**
     * GET|HEAD: /backend/users/block/{id}
     * ROUTE:    users.block
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testBlockUser()
    {
        factory(Spatie\Permission\Models\Permission::class)->create(['name' => 'blocked']);
        factory(Spatie\Permission\Models\Permission::class)->create(['name' => 'active']);

        $route = route('users.block', ['id' => $this->user->id]);

        $this->authentication();
        $this->get($route);
        $this->seeStatusCode(302);
        $this->session([
            'class'     => 'alert alert-success',
            'message'   => trans('flash-session.user-block')
        ]);
    }

    /**
     * GET|HEAD: /backend/users/unblock/{id}
     * ROUTE:    users.unblock
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testUnblockUser()
    {
        factory(Spatie\Permission\Models\Permission::class)->create(['name' => 'blocked']);
        factory(Spatie\Permission\Models\Permission::class)->create(['name' => 'active']);

        $route = route('users.unblock', ['id' => $this->user->id]);

        $this->authentication();
        $this->get($route);
        $this->seeStatusCode(302);
        $this->session([
            'class'     => 'alert alert-success',
            'message'   => trans('flash-session.user-unblock')
        ]);
    }

    /**
     * POST:
     * ROUTE:
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testSearchBackend()
    {
        $user  = factory(App\User::class)->create();
        $route = route('users.search');
        $input = ['name', $user->name];

        $this->authentication();
        $this->post($route, $input);
        $this->see($user->name);
        $this->see($user->email);
        $this->see($user->created_at);
        $this->seeStatusCode(200);
    }

    /**
     * GET|HEAD:
     * ROUTE:
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testCreateViewBackend()
    {
        $this->authentication();
        $this->get(route('users.create'));
        $this->seeStatusCode(200);
    }

    /**
     * GET|HEAD: /backend/users/reset/{id}
     * ROUTE:    users.reset
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testUserPasswordReset()
    {
        $route = route('users.reset', ['id' => $this->user->id]);

        $data['class']   = 'alert alert-danger';
        $data['message'] = trans('flash-session.user-reset');

        $this->authentication();
        $this->get($route);
        $this->session($data);
        $this->dontSeeInDatabase('users', ['password' => $this->user->password]);
        $this->seeStatusCode(302);
    }

    /**
     * POST:  /backend/users
     * ROUTE: auth.new
     *
     * - with validation errors
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testCreateMethodWithError()
    {
        $this->authentication();
        $this->post(route('auth.new'), []);
        $this->assertHasOldInput();
        $this->assertSessionHasErrors();
        $this->seeStatusCode(302);
    }

    /**
     * POST:  /backend/users
     * ROUTE: auth.new
     *
     * - without validation errors
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testCreateMethodWithoutErrors()
    {
        factory(Spatie\Permission\Models\Permission::class)->create(['name' => 'active']);
        factory(Spatie\Permission\Models\Permission::class)->create(['name' => 'blocked']);

        $session['class']   = 'alert alert-success';
        $session['message'] = '';

        $input['name']  = 'Test user';
        $input['email'] = 'Test@example.be';

        $this->authentication();
        $this->dontSeeInDatabase('users', $input);
        $this->post(route('auth.new'), $input);
        $this->seeInDatabase('users', $input);
        $this->seeStatusCode(302);
        $this->session($session);
    }

    /**
     * GET|HEAD: /backend/users/destroy/1
     * ROUTE:    users.destroy
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testDeleteMethod()
    {
        $routeParam = ['id' => $this->user->id];

        $session['class']   = 'alert alert-success';
        $session['message'] = '';

        $this->authentication();
        $this->seeInDatabase('users', $routeParam);
        $this->get(route('users.destroy', ['id' => $this->user['id']]));
        $this->dontSeeInDatabase('users', $routeParam);
        $this->seeStatusCode(302);
        $this->session($session);
    }
}
