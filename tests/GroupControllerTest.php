<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class GroupControllerTest
 */
class GroupControllerTest extends TestCase
{
    // DatabaseTransactions = Used for running the queries against the database.
    // DatabaseMigrations   = Used for migrating the database tables.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @group groups
     */
    public function testFrontEndOverview()
    {

    }

    /**
     * @group groups
     */
    public function testFrontEndSpecific()
    {

    }

    /**
     *
     */
    public function updateMethod()
    {

    }
}