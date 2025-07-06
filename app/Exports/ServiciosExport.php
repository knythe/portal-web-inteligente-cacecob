<?php

namespace App\Exports;

use App\Models\servicio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ServiciosExport implements FromView
{
    public function view(): View
    {
        return view('admin.exports.servicios', [
            'servicios' => servicio::all()
        ]);
    }
}
