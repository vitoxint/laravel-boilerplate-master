<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Cotizacion;
use Carbon\Carbon;

class UpdateCotizacionVencidas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:vencida';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando , actualizar cotizaciones de vigentes a vencida';

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

        $cotizaciones = Cotizacion::where('estado','=','1')->get();

        foreach($cotizaciones as $cotizacion){

            /* $cotizacion->estado = 1;
            $cotizacion->save(); */

            $fecha_inicio = new Carbon($cotizacion->created_at); 
            $fecha_vencimiento = $fecha_inicio->addDays($cotizacion->dias_validez + 1);

             if($fecha_vencimiento <= $hoy){
                $cotizacion->estado = 3;
                $cotizacion->save();
            } 
            
        }

    }
}