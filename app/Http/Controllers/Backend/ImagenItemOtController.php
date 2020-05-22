<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\ItemOt;
use App\OrdenTrabajo;
use App\ImagenItemOt;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImagenItemOtController extends Controller
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
    public function store(Request $request )
    {
    /*     $this->validate($request, [
                       
            'url'  =>  'required|max:32048',
            
        ]); 

        $file   =   $request->file('url');

        if($file){
            $name = $file->store('/imagenes_itemot', 'public');
        }else{
            return back()->withFlashDanger('Error al guardar la imagen');
        }
          
        $imagen= ImagenItemOt::create([

            'url' => $name,
            'itemot_id'  => $item_ot->id,                 
        ]); 

     
            return back()->withFlashSuccess('Imagen registrada correctamente'); */
            //$file = $request->file->getClientOriginalName();
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


            $name = request()->file->store('/imagenes_itemot/', 'public');

            $imagen= ImagenItemOt::create([

                'url' => $name,
                'extension' => $type,
                'image_name' => $imageName,
                'size' => $size,
                'itemot_id'  => $request->input('itemot_id'),                 
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

    

    public function display(Request $request)

{

    //$path = storage_public($filename);

    $key= $request->key;
    $imagen = ImagenItemOt::find($key);

    $contents = Storage::get($imagen->url);

    return $contents;

}

    /**
     * Display the specified resource.
     *
     * @param  \App\ImagenItemOt  $imagenItemOt
     * @return \Illuminate\Http\Response
     */
    public function show(ImagenItemOt $imagenItemOt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImagenItemOt  $imagenItemOt
     * @return \Illuminate\Http\Response
     */
    public function edit(ImagenItemOt $imagenItemOt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImagenItemOt  $imagenItemOt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImagenItemOt $imagenItemOt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImagenItemOt  $imagenItemOt
     * @return \Illuminate\Http\Response
     */
    public function destroy(/* ImagenItemOt $imagen */ Request $request)
    {

       $key= $request->key;
       $imagen = ImagenItemOt::find($key);
       Storage::disk('public')->delete($imagen->url);
       $imagen->delete();
        
       echo 0;  

    //return json_encode(array('success' => true, 'somedata' => "somedata"));

      
    }
}
