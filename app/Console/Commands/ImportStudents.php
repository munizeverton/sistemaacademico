<?php

namespace App\Console\Commands;

use App\Models\Aluno;
use App\Service\AlunoService;

class ImportStudents extends ImportCsvCommand
{
    const DELIMITER = ';';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:students {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa alunos a partir do CSV';

    private $alunoService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->alunoService = new AlunoService();
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
            $this->importAlunoByCsvLine($line);
        }

        $bar->finish();

        \DB::commit();
    }

    private function importAlunoByCsvLine($line)
    {
        $arrayLine = explode(self::DELIMITER, $line);

        $data['nome'] = $this->getColumn(1, $arrayLine);

        try {
            $cpf = $this->validaCpf($this->getColumn(2, $arrayLine));
        } catch (\Exception $e){
            $this->warn(' - Ocorreu um erro ao importar o aluno ' . $data['nome'] . ' - ' . $e->getMessage());
            return;
        }

        $data['id'] = $this->getColumn(0, $arrayLine);

        $data['cpf'] = $cpf;
        $data['rg'] = $this->getColumn(3, $arrayLine);
        $data['telefone'] = $this->getColumn(4, $arrayLine);
        $data['data_nascimento'] = $this->getColumn(5, $arrayLine);

        $aluno = $this->alunoService->store($data);

        $this->info(' - Aluno ' . $aluno->nome . ' importado');
    }

    private function validaCpf($cpf)
    {
        $validator = \Validator::make(['cpf' => $cpf], [
            'cpf' => 'cpf'
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->getMessageBag()->get('cpf')[0]);
        }

        if (strlen($cpf) == 11) {
            $cpf = self::mask('###.###.###-##', $cpf);
        }

        if (!empty(Aluno::whereCpf($cpf)->first())){
            throw new \Exception('Aluno já cadastrado');
        }

        return $cpf;
    }

    public static function mask($mask, $str)
    {
        $str = str_replace(" ", "", $str);

        for ($i = 0; $i < strlen($str); $i++) {
            $mask[strpos($mask, "#")] = $str[$i];
        }

        return $mask;
    }
}
