<?php
 
namespace App\Exports;
 
use App\OrdenTrabajo;
use App\ItemOt;
use App\EtapaItemOt;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
 
class EtapaItemOtExport implements FromCollection ,WithHeadings,ShouldAutoSize ,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function collection()
    {

        $items = EtapaItemOt::where('estado_avance', '4')->orderBy('fh_termino', 'asc')->get();

        $coleccion = array();

        foreach($items as $item){

            switch($item->proceso->tipo_valorizacion){
                case 1:
                   $medicion = 'Horas máquina';
                break;
                case 2:
                    $medicion = 'Kilogramos';
                break;
                case 3:
                    $medicion = 'Operaciones';
                break;
                default:
                    $medicion = '';
            break;
            }

            array_push($coleccion, ([
                'folio_ot'     => $item->itemOt->ordenTrabajo->folio,
                'folio_item'   => $item->itemOt->folio,
                'codigo'       => $item->codigo,
                'proceso'      => $item->proceso->descripcion,
                'maquina'      => $item->maquina->nombre,
                'descripcion'  => $item->detalle,
                'fecha_inicio' => $item->fh_inicio,
                'fecha_termino'=> $item->fh_termino,
                'tiempo_asignado'=> $item->tiempo_asignado,
                'valor_unitario'  => $item->valor_unitario,
                'cantidad'        => $item->cantidad,
                'medicion'        => $medicion, //tipo_valorizacion
                'valor_proceso'   => $item->valor_proceso
                

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
            'Código proceso',
            'Proceso',
            'Máquina',
            'Detalle',
            'Inicio',
            'Termino' , 
            'Tiempo asignado',
            'Valor unitario',
            'Cantidad',
            'Medición',
            'Valor Total Proceso',

        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:M1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

}