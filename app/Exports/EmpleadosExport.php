<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class EmpleadosExport implements FromView, ShouldAutoSize
{
    public  $empleados;
   

    function __construct($empleados)
    {
        $this->empleados = $empleados;
    }

    public function view(): View
    {

        return view('admin.empleados.empleados-export', [
            'empleados' => $this->empleados,
        ]);
    }
}
