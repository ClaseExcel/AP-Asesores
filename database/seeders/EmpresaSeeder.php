<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $empresa = [
            [
                'NIT'                => '1111111',
                'razon_social'       => 'AP Asesores Contables Integrales',
                'numero_contacto'    => '3154391681',
                'correo_electronico' => 'apasesorescontables@gmail.com',
                'direccion_fisica'   => 'Carrera 17 G # 23 - 41, Santiago de Cali, Colombia, 760042',
                'frecuencia_id'      => 1
            ],            
        ];

        Empresa::insert($empresa);
    }
}
