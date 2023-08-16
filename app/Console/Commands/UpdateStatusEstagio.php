<?php

namespace App\Console\Commands;

use App\Models\Estagio;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateStatusEstagio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Update:StatusEstagio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualizando o status com base na data de fim';

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
        $estagios = Estagio::where('status',true)
            ->whereDate('data_fim', '<', Carbon::now())
            ->get();
        
        foreach($estagios as $estagio){
            $estagio->update(['status' => false]);
        }

    }
}
