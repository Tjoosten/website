<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ActivityControllerTest
 */
class ActivityControllerTest extends TestCase
{
    // DatabaseMigrations   = Trait for running the db migrations each test.
    // DatabaseTransactions = Trait for running qeuries against the db stub.
    use DatabaseMigrations, DatabaseTransactions;
    
    /**
     * GET|HEAD: /backend/activity
     * ROUTE:    activity.index
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testOverview()
    {
        $this->authentication();
        $this->rentalSetup();
        $this->visit(route('activity.index'));
        $this->seeStatusCode(200);
    }

    /**
     * POST:    /backend/activity
     * ROUTE:   activity.store
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testInsertWithOutError()
    {
        // Route
        // $route = route('activity.store');

        // Session
        // $session['class']   = 'alert alert-success';
        // $session['message'] = '';

        // Testing logic.
        // $this->authentication();
        // $this->post($route, $input);
        // $this->seeStatusCode(302);
    }

    /**
     * POST:    /backend/activity
     * ROUTE:   activity.store
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testInsertWithError()
    {
        $this->authentication();
        $this->post(route('activity.store'), []);
        $this->seeStatusCode(302);
        $this->assertHasOldInput();
        $this->assertSessionHasErrors();
    }

    /**
     * PUT|PATCH: /backend/activity/update/{id}
     * ROUTE:     activity.update
     *
     * - Update method with validation errors.
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testUpdateError()
    {
        $activity = factory(App\Activity::class)->create();

        $this->authentication();
        $this->post(route('activity.update', ['id' => $activity->id]));
        $this->seeStatusCode(302);
        $this->assertSessionHasErrors();
        $this->assertHasOldInput();
    }

    /**
     * @group all
     * @group activity
     * @group back-end
     */
    public function testUpdateWithOutError()
    {
        $activity = factory(App\Activity::class)->create();
        $this->authentication();
        $this->post (route('activity.update', ['id' => $activity->id]) , [
            'heading' => 'This is the updated heading for the activity.',
            'description' => 'This is the updated description',
            'state'       => 1,
            'group'       => 'required', 
            'start_time'  => 1476466655,
            'date'        => '2016-10-13 17:33:31',
            'end_time'    => 1476496655, 
        ]);
        $updatedActivity = App\Activity::find($activity->id);
        $this->seeStatusCode(302);
        $this->assertSessionHas('success', 'alert alert-success');
        $this->assertRedirectedToRoute('home');
        $this->assertEquals('This is the updated heading for the activity.', $updatedActivity->heading);
        $this->assertEquals('This is the updated description', $updatedActivity->description);
    }

    /**
     * GET|HEAD:  /backend/activity/destroy/{id}
     * ROUTE:     activity.destroy
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testDestroyActivity()
    {
        $activity = factory(App\Activity::class)->create();
        $group    = factory(App\Groups::class)->create();
        $data     = ['id' => $activity->id];
        $route    = route('activity.destroy', $data);

        $session['class'] = 'alert alert-success';
        $session['message'] = '';

        $this->authentication();
        $this->seeInDatabase('activities', $data);
        $this->get($route);
        $this->dontSeeInDatabase('activities', $data);
        $this->seeStatusCode(302);
        $this->session($session);
    }

    /**
     * GET|HEAD:  /backend/activity
     * ROUTE:     activity.store
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testActivityStorePublishedSuccesfully()
    {
        $user  = factory(App\User::class)->create();
        $group = factory(App\Groups::class)->create();

        $this->actingAs($user)->visit('/backend/activity')
            ->type('framework for artisan web', 'description')
            ->type('This is new activity', 'heading')
            ->type('2016-10-14 14:50:51', 'date')
            ->type('2016-10-14 14:50:51', 'start_time')
            ->type('2016-10-14 14:50:51', 'end_time')
            ->type(1, 'state')
            ->type($group->id, 'group')
            ->press('Aanmaken')
            ->see('This is new activity');
    }

    /**
     *
     */
    public function testEditView()
    {

    }

     /**
     * GET|HEAD:  /backend/activity
     * ROUTE:     activity.store
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testActivityStoreDraftedSuccesfully()
    {
        $user  = factory(App\User::class)->create();
        $group = factory(App\Groups::class)->create();

        $this->actingAs($user)->visit('/backend/activity')
            ->type('framework for artisan web', 'description')
            ->type('This is new activity', 'heading')
            ->type('2016-10-14 14:50:51', 'date')
            ->type('2016-10-14 14:50:51', 'start_time')
            ->type('2016-10-14 14:50:51', 'end_time')
            ->type(0, 'state')
            ->type($group->id, 'group')
            ->press('Aanmaken')
            ->see('This is new activity');
    }

    /**
     * GET|HEAD:  /backend/activity
     * ROUTE:     activity.store
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testActivityStoreUnsuccesfullyDueToMissingFields()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user)->visit('/backend/activity')
            ->press('Aanmaken')
            ->see('Er zijn geen klad activiteiten');
    }

    /**
     * @group all
     * @group activity
     * @group back-end
     */
    public function testEdit()
    {

    }
}
