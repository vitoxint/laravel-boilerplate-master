<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use PDF;
use App\Models\Auth\User;

use App\SolicitudCotizacion;
use App\ItemSc;



/**
 * Class SendContact.
 */
class RecibirSolicitudCotizacion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Cotizacion
     */
    public $cotizacion;
    public $usuario;

    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct(SolicitudCotizacion $cotizacion ,User $usuario)
    {
        $this->cotizacion = $cotizacion;
        $this->usuario = $usuario;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$usuarios = User::whereHas("permissions", function($q){ $q->where("name", "administrar cotizaciones"); })->get();

/*         $usuarios = User::permission('administrar cotizaciones')->get('email', 'full_name');
        $usuario = User::find(1); */


        $cotizacion = $this->cotizacion;
        $usuario = $this->usuario;

        $cssToInlineStyles = new CssToInlineStyles();

        $html = view('backend.s_cotizacion.mail.recibir_aviso',compact('cotizacion','usuario'));

        return $this->to($usuario->email, $usuario->first_name .' '. $usuario->last_name)

            ->html($cssToInlineStyles->convert($html))
            ->subject('Aviso de solicitud de cotización')
            ->from('system@orecal.cl', 'Orecal servicios y ventas')
            //->replyTo($this->cotizacion->usuario->email, $this->cotizacion->usuario->first_name . ' ' .$this->cotizacion->usuario->last_name)
            ;
    }
}
