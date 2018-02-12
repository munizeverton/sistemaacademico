<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

abstract class ImportCsvCommand extends Command
{
    protected $arrayLines;

    protected $signature = 'import {file}';

    protected function readFile($file)
    {
        try {
            $handle = file($file);
        } catch (\Exception $e) {
            $this->error('Não foi possível ler o arquivo');
            throw $e;
        }

        if ($handle === false) {
            $this->error('Arquivo não encontrado');
            throw new \Exception('Arquivo não encontrado');
        }

        unset($handle[0]);

        $this->arrayLines = $handle;
    }

    protected function getLines()
    {
        return $this->arrayLines;
    }

    protected function getColumn($column, $line)
    {
        return str_replace('"', '', $line[$column]);
    }
}
