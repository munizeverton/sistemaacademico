<?php

namespace App\Console\Commands;

use App\Models\Periodo;
use App\Service\CursoService;

class ImportCourses extends ImportCsvCommand
{
    const DELIMITER = ',';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:courses {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa cursos a partir do CSV';

    private $cursoService;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->cursoService = new CursoService();
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
            $this->importCursoByCsvLine($line);
        }

        $bar->finish();

        \DB::commit();
    }

    private function importCursoByCsvLine($line)
    {
        $arrayLine = explode(self::DELIMITER, $line);
        $data['id'] = $this->getColumn(0, $arrayLine);
        $data['nome'] = $this->getColumn(1, $arrayLine);
        $data['valor_mensalidade'] = $this->getColumn(2, $arrayLine);
        $data['valor_matricula'] = $this->getColumn(3, $arrayLine);
        $data['duracao'] = $this->getColumn(5, $arrayLine);

        $periodoNome = $this->getColumn(4, $arrayLine);
        $periodo = Periodo::whereNome(ucfirst($periodoNome))->first();

        $data['periodo_id'] = $periodo->id;

        if (empty($periodo)) {
            $this->warn(' - Ocorreu um erro ao importar o curso ' . $data['nome'] . '. Período ' . $periodoNome . ' não encontrado');
            return;
        }

        $curso = $this->cursoService->store($data);

        $this->info(' - Curso ' . $curso->nome . ' importado');
    }
}
