<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Contact\SendContactRequest;
use App\Mail\Frontend\Contact\SendContact;
use Illuminate\Support\Facades\Mail;


//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: GET");
/**
 * Class ContactController.
 */
class ContactController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    
    public function index()
    {
        return view('frontend.contact');
    }

    /**
     * @param SendContactRequest $request
     *
     * @return mixed
     */
    public function send(SendContactRequest $request)
    {
        Mail::send(new SendContact($request));

        return redirect()->back()->withFlashSuccess(__('alerts.frontend.contact.sent'));
    }

    public function sendApi(SendContactRequest $request)
    {
        Mail::send(new SendContact($request));

        return response()->json([
            'data'=> 'Mensaje enviado correctamente, pronto nos contactaremos con usted para atender a su requerimiento',
            
           
            ]); 
    }



}


