<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\OrdenTrabajo;
use Carbon\Carbon;

use App\Mail\Backend\SendOtSinEntregar;
use Illuminate\Support\Facades\Mail;

class NotificarOtSinEntregar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:otnoentregada';

    /**noentregada
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifica las ordenes de trabajo que estan terminadas y no han sido entregada en el día que se termino o en la fecha comprometida';

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

        $ordenTrabajos = OrdenTrabajo::where('estado','=','4')->get();

        foreach($ordenTrabajos as $ordenTrabajo){

            $fecha_termino = new Carbon($ordenTrabajo->fecha_termino); 

             if($fecha_termino < $hoy){
                Mail::send(new SendOtSinEntregar($ordenTrabajo));
            } 
            
        }
    }
}
