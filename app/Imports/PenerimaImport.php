<?php

namespace App\Imports;

use App\Models\Penerima;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenerimaImport implements ToModel , WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new Penerima([
            'nik' => $row[1],
            'no_kk' => $row[2],
            'name' => $row[3],
            'alamat' => $row[4],
            'jenis_kelamin' => $row[6],
            'pekerjaan' => $row[7],
            'status_kawin' => $row[8],
            'dtks' => $row[9],
            'dtks2_kk' => $row[10],
            'nominal_bantuan' => $row[15],
        ]);
    }
}
