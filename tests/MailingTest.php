<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MailingTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD: /backend/mailing
     * ROUTE:    backend.mailing.index
     *
     * @group mailing
     * @group all
     */
    public function testBackendEndIndex()
    {
        $this->authentication();
        $this->get(route('backend.mailing.index'));
        $this->seeStatusCode(200);
    }

    /**
     *
     */
    public function testMailingDestory()
    {

    }

    /**
     *
     */
    public function testNewsLetterDestroy()
    {

    }

    /**
     *
     */
    public function testNewsLetterCreateWithErrors()
    {

    }

    public function testNewsLetterInsertWithoutErrors()
    {

    }

    /**
     * POST:  /newsletter/register
     * ROUTE: newsletter.register
     *
     * - With validation errors.
     *
     * @group mailing
     * @group newsletter
     * @group all
     */
    public function testMailingInsertWithError()
    {
        $this->post(route('newsletter.register'), []);
        $this->seeStatusCode(302);
        $this->assertHasOldInput();
    }

    /**
     * POST:  /newsletter/register
     * ROUTE: newsletter.register
     *
     * - Without validation errors.
     *
     * @group mailing
     * @group newsletter
     * @group all
     */
    public function testMailingInsertWithoutError()
    {
        factory(Spatie\Permission\Models\Permission::class)->create();

        $input['email'] = 'jhon@doe.tld';

        $this->post(route('newsletter.register'), $input);
        $this->seeInDatabase('news_letters', $input);
        $this->seeStatusCode(302);
    }

    /**
     *
     */
    public function testMailingUpdateWithoutErrors()
    {
        $this->authentication();
    }

    /**
     *
     */
    public function testMailingUpdateWithErrors()
    {
        $this->authentication();
    }
}
