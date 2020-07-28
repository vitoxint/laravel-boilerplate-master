<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use PDF;

use App\SolicitudCotizacion;
use App\ItemSc;
use App\Models\Auth\User;

/**
 * Class SendContact.
 */
class SendRespuestaSolicitudCotizacion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Cotizacion
     */
    public $cotizacion;

    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct(SolicitudCotizacion $cotizacion)
    {
        $this->cotizacion = $cotizacion;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $usuario = $this->cotizacion->usuario;
        $cotizacion = $this->cotizacion;

        $cssToInlineStyles = new CssToInlineStyles();

        $html = view('backend.s_cotizacion.mail.send_cotizacion',compact('cotizacion'));

        $pdf = PDF::loadView('backend.s_cotizacion.print', compact('cotizacion','usuario'));

        

        //$pdf->download('cotizacion_'.$cotizacion->folio.'.pdf');

        //return $cssToInlineStyles->convert($html);

        return $this->to($this->cotizacion->email_solicitante, $this->cotizacion->contacto)
            //->view('backend.cotizaciones.mail.send_cotizacion')
            //->text($cssToInlineStyles->convert($html))
            ->html($cssToInlineStyles->convert($html))
            ->attachData($pdf->output(), 'cotizacion_'.$this->cotizacion->id.'.pdf', [
                'mime' => 'application/pdf',
            ])
            ->subject('Maestranza Orecal - Respuesta a la solicitud de cotización')
            ->from('system@orecal.cl', 'Orecal servicios y ventas')
            ->replyTo($this->cotizacion->usuario->email, $this->cotizacion->usuario->first_name . ' ' .$this->cotizacion->usuario->last_name);
    }
}
