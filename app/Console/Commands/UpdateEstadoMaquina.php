<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Maquina;
use App\EtapaItemOt;

class UpdateEstadoMaquina extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:updateestadomaquina';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el estado de la máquina en uso';

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
     * @return mixed
     */
    public function handle()
    {
        $maquinas = Maquina::all();

        foreach($maquinas as $maquina){

            $count = 0;
            foreach($maquina->etapaItemOt as $proceso){
                if($proceso->estado_avance == 2 || $proceso->estado_avance == 3 ){
                    $count++;
                }
            }
            if($count >= 1 ){
                $maquina->update([
                    'estado' => '3',
                ]); 
                
            }else{
                if($maquina->estado != '2' || $maquina->estado != '4'){
                    $maquina->update([
                    'estado' => '1',
                ]); 
            }
        }
    }
        
    }
}
