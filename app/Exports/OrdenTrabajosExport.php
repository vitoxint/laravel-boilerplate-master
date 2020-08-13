<?php
 
namespace App\Exports;
 
use App\OrdenTrabajo;
use App\ItemOt;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
 
class OrdenTrabajosExport implements FromCollection ,WithHeadings,ShouldAutoSize ,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function collection()
    {

        $items = ItemOt::where('estado', '5')->get();

        $coleccion = array();

        foreach($items as $item){

            array_push($coleccion, ([
                'folio_ot'     => $item->ordenTrabajo->folio,
                'folio_item'   => $item->folio,
                'rut_cliente'  => $item->ordenTrabajo->cliente->rut_cliente,
                'razon_social' => $item->ordenTrabajo->cliente->razon_social,
                'descripcion'  => $item->descripcion,
                'valor_unitario'=> $item->valor_unitario,
                'cantidad'      => $item->cantidad,
                'valor_neto'    => $item->valor_parcial,
                'fecha_termino' => $item->fecha_termino,
                'factura'       => $item->ordenTrabajo->factura,

            ]));
            //'cliente_id', 'folio', 'representante_id','user_id', 'estado' , 'estado_pago','factura','cotizacion','orden_compra','fecha_inicio','fecha_termino','entrega_estimada',
            //'valor_total', 'created_at'
            //'id','cantidad', 'ot_id', 'folio' ,'valor_unitario','valor_parcial' ,'descripcion','estado','especificaciones','fecha_inicio','fecha_termino'
          
        }

        //return Cliente::all();

        return collect([ $coleccion  ]);
        //return $coleccion;
    }


    public function headings(): array
    {
        return [
            'OT',
            'Item',
            'RUT Cliente',
            'Cliente',
            'Descripción',
            'Valor Unitario',
            'Cantidad',
            'Valor Neto' , 
            'Fecha Termino',
            'Factura',

        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:J1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

}