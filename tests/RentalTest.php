<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RentalTest extends TestCase
{
    // DatabaseMigrations   = Running migrations agianst the database stub.
    // DatabaseTransactions = Running queries against the database stub.
    use DatabaseMigrations, DatabaseTransactions;

    public function setUp() {
        parent::setUp();

        $this->seed('RentalStatusSeeder');
    }
    /**
     * GET|HEAD:  /rental
     * ROUTE:     rental.frontend.index
     *
     * @group all
     * @group frontend
     * @group rental
     */
    public function testFrontendOverView()
    {
        $this->visit(route('rental.frontend.index'));
        $this->seeStatusCode(200);
    }
    /**
     * GET\HEAD:  /backend/rental
     * ROUTE:     rental.backend
     *
     * @group backend
     * @group all
     * @group rental
     */
    public function testBackendOverView()
    {
        $this->authentication();
        $this->visit(route('rental.backend'));
        $this->seeStatusCode(200);
    }
    /**
     * POST:  /rental/insert
     * ROUTE: rental.store
     *
     * @group frontend
     * @group backend
     * @group all
     * @group rental
     */
    public function testRentalInsertErrors()
    {
        $this->post(route('rental.store'), []);
        $this->seeStatusCode(302);
        $this->assertHasOldInput();
        $this->assertSessionHasErrors();
    }

    /**
     * GET\HEAD: /rental/reachable
     * ROUTE:    rental.frontend.reachable
     *
     * @group frontend
     * @group backend
     * @group all
     * @group rental
     */
    public function testReachablePage()
    {
        $this->visit(route('rental.frontend.reachable'));
        $this->seeStatusCode(200);
    }

    /**
     * POST:  /rental/insert
     * ROUTE: rental.store
     *
     * @group frontend
     * @group backend
     * @group all
     * @group rental
     */
    public function testRentalInsertSuccess()
    {
        $rental = factory(App\Rental::class)->make();
        $check = [
          'group' => $rental->group,
          'phone_number' => $rental->phone_number,
          'email' => $rental->email,
          'start_date' => $rental->start_date->timestamp,
          'end_date' => $rental->end_date->timestamp
        ];

        $this->authentication();
        $this->dontSeeInDatabase('rentals', $check);
        $this->post(route('rental.store', $rental->toArray()));
        $this->seeInDatabase('rentals', $check);
        $this->seeStatusCode(302);
    }

    /**
     * @group backend
     * @group all
     * @group rental
	  */
	   public function testRentalUpdateView()
     {
     }
     /**
      * PUT\PATCH:  /backend/rental/update/{$id}
      * ROUTE:      rental.backend.update
      *
      * @group backend
      * @group all
      * @group rental
     */
     public function testRentalUpdateWithoutSuccess()
     {
        $rental = factory(App\Rental::class)->create();
        $data = ['id' => $rental->id];

        $this->authentication();
        $this->post(route('rental.backend.update', $data));
        $this->seeStatusCode(302);
        $this->assertSessionHasErrors();
        $this->assertHasOldInput();
     }

     /**
      * PUT\PATCH:  /backend/rental/update/{$id}
      * ROUTE:      rental.backend.update
      *
      * @group backend
      * @group all
      * @group rental
     */
     public function testRentalUpdateWithSuccess()
     {
        $rental = factory(App\Rental::class)->create();
        $rentalUpdate = factory(App\Rental::class)->make()->toArray();
        $rentalUpdate['id'] = $rental->id;

        $this->authentication();
        $this->dontSeeInDatabase('rentals', $rentalUpdate);
        $this->put(route('rental.backend.update'));
        $this->seeInDatabase('rentals', $rentalUpdate);
        $this->seeStatusCode(302);
     }

    /**
     * GET\HEAD:  /backend/rental/destroy/{$id}
     * ROUTE:     rental.backend.destroy
     *
     * @group backend
     * @group all
     * @group rental
     */
    public function testRentalDelete()
    {
        $rental = factory(App\Rental::class)->create();
        $data = ['id' => $rental->id];

        $session['class'] = 'alert alert-success';
        $session['message'] = '';

        $this->authentication();
        $this->seeInDatabase('rentals', $data);
        $this->get(route('rental.backend.destroy', $data));
        $this->dontSeeInDatabase('rentals', $data);
        $this->seeStatusCode(302);
        $this->session($session);
    }

    /**
     * GET|HEAD: /rental/calendar
     * ROUTE:    rental.frontend-calendar
     *
     * @group frontend
     * @group all
     * @group rental
     */
    public function testRentalCalendar()
    {
        $this->visit(route('rental.frontend-calendar'));
        $this->seeStatusCode(200);
    }

    /**
     * GET|HEAD: /rental/insert
     * ROUTE:    rental.frontend.insert
     *
     * @group frontend
     * @group all
     * @group rental
     */
    public function testRentalInsertFormFrontEnd()
    {
        $this->visit(route('rental.frontend.insert'));
        $this->seeStatusCode(200);
    }

    /**
     * GET|HEAD:  /backend/rental/insert
     * ROUTE:     rental.backend.insert
     *
     * @group rental
     * @group backend
     * @group all
     */
    public function testRentalInsertFormBackend()
    {
        $this->authentication();
        $this->visit(route('rental.backend.insert'));
        $this->seeStatusCode(200);
    }
}
