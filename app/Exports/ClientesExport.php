<?php

namespace App\Exports;

use App\Models\cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClientesExport implements FromView
{
  public function view(): View
  {
    return view('admin.exports.clientes',[
        'clientes' => cliente::all()
    ]);
  }
}
