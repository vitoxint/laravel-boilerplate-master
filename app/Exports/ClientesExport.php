<?php
 
namespace App\Exports;
 
use App\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
 
class ClientesExport implements FromCollection ,WithHeadings,ShouldAutoSize ,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function collection()
    {

        $clientes = Cliente::all();

        $coleccion = array();

        foreach($clientes as $cliente){

            array_push($coleccion, ([

                'rut_cliente'  => $cliente->rut_cliente,
                'razon_social' => $cliente->razon_social,
                'direccion'    => $cliente->direccion,
                'comuna'       => $cliente->commune->name,
                'region'       => $cliente->commune->region->name,
                'telefono'     => $cliente->telefono,
                'celular'      => $cliente->celular,
                'email'        => $cliente->email,
                'giro_comercial'=> $cliente->giro_comercial

            ]));

          //  'rut_cliente', 'razon_social', 'telefono','celular','email','direccion','region','commune', 'region_id', 'commune_id', 'slug','giro_comercial'
        }

        //return Cliente::all();

        return collect([ $coleccion  ]);
        //return $coleccion;
    }


    public function headings(): array
    {
        return [
            'RUT',
            'Razón social',
            'Dirección',
            'Comuna',
            'Región',
            'Teléfono',
            'Celular/Whatsapp',
            'Email' , 
            'Giro comercial'

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