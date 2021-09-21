<?php

namespace App\Exports;

use App\Models\Penerima;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenerimaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Penerima::all();
    }
}
