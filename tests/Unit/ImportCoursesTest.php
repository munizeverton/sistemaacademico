<?php

namespace Tests\Feature;

use App\Models\Curso;
use Tests\DatabaseTestCase;

class ImportCoursesTest extends DatabaseTestCase
{
    const COMMAND = 'import:courses';

    public function testGetInvalidFile()
    {
        $this->expectExceptionMessage( 'file(tests/invalidfile.csv): failed to open stream: No such file or directory');
        \Artisan::call(self::COMMAND, ['file' => 'tests/invalidfile.csv']);

        $this->expectExceptionMessage('Not enough arguments (missing: "file")');
        \Artisan::call(self::COMMAND);
    }

    public function testImportCsv()
    {
        \Artisan::call(self::COMMAND, ['file' => 'tests/fakedata/courses_file.csv']);
        $this->assertCount(5, Curso::all());
    }
}
