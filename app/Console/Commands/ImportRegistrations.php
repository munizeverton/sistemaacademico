<?php

namespace App\Console\Commands;

use App\Models\Aluno;
use App\Models\Curso;
use App\Service\MatriculaService;
use Illuminate\Validation\ValidationException;

class ImportRegistrations extends ImportCsvCommand
{
    const DELIMITER = ';';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:registrations {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa matrículas a partir do CSV';

    private $matriculaService;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->matriculaService = new MatriculaService();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        \DB::beginTransaction();

        $fileName = $this->argument('file');
        $this->readFile($fileName);
        $this->info('Inciando importação...');
        $bar = $this->output->createProgressBar(count($this->getLines()));

        foreach ($this->getLines() as $line) {
            $bar->advance();
            $this->importMatriculaByCsvLine($line);
        }

        $bar->finish();

        \DB::commit();
    }

    private function importMatriculaByCsvLine($line)
    {
        $arrayLine = explode(self::DELIMITER, $line);

        if (count($arrayLine) < 4) {
            return;
        }

        $alunoId = $this->getColumn(1, $arrayLine);
        $cursoId = $this->getColumn(2, $arrayLine);
        $ano = (int)$this->getColumn(3, $arrayLine);

        if (empty(Aluno::find($alunoId))) {
            $this->warn(' - Ocorreu um erro ao importar a matrícula ' . $this->getColumn(0, $arrayLine) . '. Aluno não encontrado');
            return;
        }

        if (empty(Curso::find($cursoId))) {
            $this->warn(' - Ocorreu um erro ao importar a matrícula ' . $this->getColumn(0, $arrayLine) . '. Curso não encontrado');
            return;
        }

        try {
            $this->matriculaService->store($alunoId, $cursoId, $ano);
        } catch(ValidationException $e) {
            $this->warn(' - Ocorreu um erro ao importar o matrícula ' . $this->getColumn(0, $arrayLine) . ' - ' . $e->validator->errors()->first());
            return;
        }

        $this->info(' - Matricula ' . $this->getColumn(0, $arrayLine) . ' importada');
    }
}
