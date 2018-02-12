<?php

namespace Tests\Feature;

use App\Models\Aluno;
use App\Models\Matricula;
use Tests\DatabaseTestCase;

class ImportRegistrationsTest extends DatabaseTestCase
{
    const COMMAND = 'import:registrations';

    public function testGetInvalidFile()
    {
//        $this->expectExceptionMessage( 'file(tests/invalidfile.csv): failed to open stream: No such file or directory');
//        \Artisan::call(self::COMMAND, ['file' => 'tests/invalidfile.csv']);
//
//        $this->expectExceptionMessage('Not enough arguments (missing: "file")');
//        \Artisan::call(self::COMMAND);
    }

    public function testImportCsvMatriculas()
    {
//        \Artisan::call(ImportCoursesTest::COMMAND, ['file' => 'tests/fakedata/courses_file.csv']);
//        \Artisan::call(ImportStudentsTest::COMMAND, ['file' => 'tests/fakedata/students_file.csv']);
//        \Artisan::call(self::COMMAND, ['file' => 'tests/fakedata/registrations_file.csv']);
//        $this->assertCount(5, Matricula::all());
    }
}
