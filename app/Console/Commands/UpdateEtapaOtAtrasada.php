<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\EtapaItemOt;
use Carbon\Carbon;

class UpdateEtapaOtAtrasada extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:etapaotatrasada';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza las Ot atrasadas';

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
        
        $ahora = Carbon::now();

        $etapasItemsOt = EtapaItemOt::where('estado_avance','=',1)->orWhere('estado_avance','=',2)->orWhere('estado_avance','=',5)->get();

        foreach($etapasItemsOt as $etapa){

            $fecha_limite = new Carbon($etapa->fh_limite); 
            $ahora = $ahora->format('Y-m-d H:i:s');

             if($fecha_limite <= $ahora ){
                $etapa->estado_avance = 3;
                $etapa->save();
            } 
            
        }

    }
}
