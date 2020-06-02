<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use PDF;

use App\OrdenTrabajo;
use App\ItemOt;
use App\Models\Auth\User;

/**
 * Class SendContact.
 */
class SendOtSinEntregar extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Cotizacion
     */
    public $ordenTrabajo;

    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct(OrdenTrabajo $ordenTrabajo)
    {
        $this->ordenTrabajo = $ordenTrabajo;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $ordenTrabajo = $this->ordenTrabajo;

        $cssToInlineStyles = new CssToInlineStyles();

        $html = view('backend.orden_trabajos.mail.send_ot_noentregadas',compact('ordenTrabajo'));

        return $this->to($this->ordenTrabajo->usuario->email, $this->ordenTrabajo->usuario->first_name . ' '. $this->ordenTrabajo->usuario->last_name)
            ->html($cssToInlineStyles->convert($html))
            ->subject('Notificación de Orden de Trabajo no entregada')
            ->from('system@orecal.cl', 'Orecal Sistemas Informáticos');
           
    }
}
