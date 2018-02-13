<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class DatabaseTestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp()
    {
        parent::setUp();
        \Artisan::call('migrate:reset');
        \Artisan::call('migrate');
        \Artisan::call('db:seed');
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
