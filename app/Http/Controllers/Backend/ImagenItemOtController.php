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
    public function store(Request $request/* , ItemOt $item_ot  */)
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

            //request()->file->move(public_path('upload'), $imageName);
            request()->file->store('/imagenes_itemot', 'public');
    
    
            return response()->json(['uploaded' => '/imagenes_itemot/'.$imageName]);
    
        

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
    public function destroy(ImagenItemOt $imagen)
    {
        Storage::disk('public')->delete($imagen->url);   
        $imagen->delete();

        return back()->withFlashSuccess('Imagen eliminada correctamente');
    }
}
