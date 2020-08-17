<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\OrdenTrabajo;
use Carbon\Carbon;

use App\Mail\Backend\SendOtAtrasada;
use Illuminate\Support\Facades\Mail;

class UpdateOtAtrasada extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:otatrasada';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza los estados de las ordenes de trabajo de sin iniciar o em proceso a atrasadas si la fecha compromiso no se cumple';

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

        $hoy = Carbon::now();
        //$hoy = $hoy->addDays(1);

        //$sts = ['1','2'];
        $ordenTrabajos = OrdenTrabajo::whereIn('estado',['1','2'])->get();

        foreach($ordenTrabajos as $ordenTrabajo){

            $fecha_compromiso = new Carbon($ordenTrabajo->entrega_estimada);
            
        
             if($fecha_compromiso->addDays(1) < $hoy){
                $ordenTrabajo->estado = '3';
                $ordenTrabajo->save();

                $items = $ordenTrabajo->item_ots;

                foreach($items as $item ){

                    if(($item->estado != '4')&&($item->estado != '5')){
                        $item->update([
                            'estado' => '3',
                        ]);

                    }
                }


                Mail::send(new SendOtAtrasada($ordenTrabajo));
            } 
            
        }
    }
}
