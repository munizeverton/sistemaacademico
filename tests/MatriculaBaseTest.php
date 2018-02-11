<?php

namespace Tests;

use App\Models\Curso;
use App\Service\CursoService;
use App\Service\MatriculaService;

abstract class MatriculaBaseTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        \Artisan::call('migrate');
        \Artisan::call('db:seed', ['--env' => 'testing']);
    }

    public function tearDown()
    {
        \Artisan::call('migrate:reset');
        parent::tearDown();
    }

    /**
     * @return MatriculaService
     */
    public function getService()
    {
        return new MatriculaService();
    }
}
