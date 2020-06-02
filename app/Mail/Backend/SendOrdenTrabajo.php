<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use PDF;

use App\OrdenTrabajo;
use App\Models\Auth\User;

/**
 * Class SendContact.
 */
class SendOrdenTrabajo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @varOrdenTrabajo
     */
    public $trabajo;

    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct(OrdenTrabajo $trabajo)
    {
        $this->trabajo = $trabajo;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $usuario = $this->trabajo->usuario;
        $trabajo = $this->trabajo;

        $cssToInlineStyles = new CssToInlineStyles();

        $html = view('backend.orden_trabajos.mail.send_orden_trabajo',compact('trabajo'));
        $pdf = PDF::loadView('backend.orden_trabajos.printCliente', compact('trabajo'));


        return $this->to($this->trabajo->usuario->email, $this->trabajo->usuario->first_name . ' ' . $this->trabajo->usuario->last_name )
            //->view('backend.cotizaciones.mail.send_cotizacion')
            //->text($cssToInlineStyles->convert($html))
            ->html($cssToInlineStyles->convert($html))
            ->attachData($pdf->output(), 'OrdenTrabajo_'.$this->trabajo->folio.'.pdf', [
                'mime' => 'application/pdf',
            ])
            ->subject('Notificación de Orden de Trabajo emitida')
            ->from('system@orecal.cl', 'Orecal servicios y ventas')
            ->replyTo($this->trabajo->usuario->email, $this->trabajo->usuario->first_name . ' ' .$this->trabajo->usuario->last_name);
    }
}
