<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LimparArquivosTemp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'limpar:arquivos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exclui arquivos na pasta tmp do storage periodicamente';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $diretorio = storage_path('app/docs/tmp');

        File::cleanDirectory($diretorio);

        $this->info('Arquivos excluídos com sucesso!');
    }
}
