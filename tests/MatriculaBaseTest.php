<?php

namespace Tests;

use App\Models\Curso;
use App\Service\CursoService;
use App\Service\MatriculaService;

abstract class MatriculaBaseTest extends DatabaseTestCase
{
    /**
     * @return MatriculaService
     */
    public function getService()
    {
        return new MatriculaService();
    }
}
