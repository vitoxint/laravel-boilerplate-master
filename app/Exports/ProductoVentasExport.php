<?php
 
namespace App\Exports;
 
use App\ProductoVenta;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
 
class ProductoVentasExport implements FromCollection ,WithHeadings,ShouldAutoSize ,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function collection()
    {

        $items = ProductoVenta::orderBy('codigo','asc')->get();

        $coleccion = array();

        foreach($items as $item){

            array_push($coleccion, ([
                'codigo'        => $item->codigo,
                'descripcion'   => $item->descripcion,
                'marca'         => $item->marca->nombre,
                'familia'       => $item->familia->nombre,
                'precio_lista'  => $item->precio_lista,
                'stock_minimo'  => $item->stock_seguridad,
                'cantidad'      => $item->existencias->sum('cantidad'),
                'valor_contable'=> (int)$item->existencias->sum('cantidad') * (int)$item->precio_lista,
                

            ]));
            //'codigo' , 'descripcion' , 'marca_id' , 'familia_producto_id' , 'imagen_url' , 'procedencia' , 'precio_lista' , 'stock_seguridad' , 'existencias'
          
        }

        //return Cliente::all();

        return collect([ $coleccion  ]);
        //return $coleccion;
    }


    public function headings(): array
    {
        return [
            'Código',
            'Descripción',
            'Marca',
            'Tipo',
            'Valor lista',
            'Stock seguridad',
            'Cantidad existente',
            'Valor Contable' , 
           

        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:H1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

}