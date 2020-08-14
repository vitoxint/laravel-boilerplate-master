<?php
 
namespace App\Exports;
 
use App\ExistenciaMaterial;
use App\Material;
use App\Deposito;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
 
class ExistenciaMaterialExport implements FromCollection ,WithHeadings,ShouldAutoSize ,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function collection()
    {

        $items = ExistenciaMaterial::orderBy('material_id','asc')->get();

        $coleccion = array();

        foreach($items as $item){

            switch ($item->material->perfil) {
                case 1:
                    $perfil = 'Barra';
                    break;

                case 2:
                    $perfil = 'Barra Perforada';
                    break;

                case 3:
                    $perfil = 'Plancha';
                    break;
                
                default:
                    $perfil = "";
                    break;
            }

            switch ($item->origen_material) {
                case 1:
                    $origen = 'Compra';
                    break;

                case 2:
                    $origen = 'Retazo';
                    break;

                case 3:
                    $origen = 'Proporcionado por cliente';
                    break;
                
                default:
                    $origen = "";
                    break;
            }

            switch ($item->material->sistema_medida){
                case 1:
                    $sufijo = ' mm';
                break;
                case 2:
                    $sufijo = ' "' ;
                break;
                default:
                    $sufijo = '' ;
                break;
            }

            array_push($coleccion, ([
                'material'        => $item->material->material,
                'perfil'          => $perfil,
                'codigo'          => $item->material->codigo, 
                'dimension_ext'   => $item->material->diam_exterior . $sufijo,
                'dimension_int'   => $item->material->diam_interior . $sufijo,
                'espesor'         => $item->material->espesor       . $sufijo,
                'origen'          => $origen,
                'detalle_origen'  => $item->detalle_origen,
                'dimension_largo' => $item->dimension_largo,
                'dimension_ancho' => $item->dimension_ancho,
                'valor_unitario'  => $item->valor_unit,
                'valor_total'     => $item->valor_total,
                'deposito'        => $item->deposito->nombre,


            ]));


           // 'material_id', 'deposito_id', 'dimension_largo', 'dimension_ancho', 'valor_unit', 'valor_total', 'estado_consumo', 'origen_material' , 'detalle_origen','user_id'
           // 'codigo','perfil','sistema_medida','diam_exterior' , 'diam_interior', 'espesor', 'densidad',  'valor_kg', 'proveedor', 'tipo_corte','material','dimensionado'
          
        }

        

        return collect([ $coleccion  ]);
        //return $coleccion;
    }


    public function headings(): array
    {
        return [
            'Descripción',
            'Perfil',
            'Código',
            'Medida Exterior',
            'Medida Interior',
            'Espesor',
            'Origen',
            'Detalle Origen',
            'Largo (mm)',
            'Ancho (mm)',
            'Valor KG',
            'Valor Trozo',
            'Depósito',

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