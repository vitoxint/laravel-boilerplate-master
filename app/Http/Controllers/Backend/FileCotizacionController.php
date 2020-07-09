<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\FileCotizacion;
use App\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileCotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imageName = request()->file->getClientOriginalName();
        $extension = request()->file->getExtension();
        $mime = request()->file->getClientMimeType();
        $size = request()->file->getSize();

        $type ='';
        $cadena = $mime;
        $array = explode('/', $mime);
        if($array[0] == 'application'){
            $type = $array[1];
        
        }
        if($array[0] == 'image'){
            $type = $array[0];
        }


        $name = request()->file->store('/imagenes_cotizacion/', 'public');

        $imagen= FileCotizacion::create([

            'url' => $name,
            'extension' => $type,
            'image_name' => $imageName,
            'size' => $size,
            'cotizacion_id'  => $request->input('cotizacion_id'),                 
        ]); 

        if(($imagen->extension != "image")&&($imagen->extension != "pdf")){
            $imagen->update(
                [
                    'extension' => "other",
                ]
            );
        }
          
        return response()->json(['uploaded' => $name]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileCotizacion  $fileCotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(FileCotizacion $fileCotizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileCotizacion  $fileCotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(FileCotizacion $fileCotizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileCotizacion  $fileCotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileCotizacion $fileCotizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileCotizacion  $fileCotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $key= $request->key;
        $imagen = FileCotizacion::find($key);
        Storage::disk('public')->delete($imagen->url);
        $imagen->delete();
         
        echo 0;  
    }


    public function display(Request $request){

    
        $key= $request->key;
        $imagen = FileCotizacion::find($key);

        $contents = Storage::get($imagen->url);

        return $contents;

    }
}
