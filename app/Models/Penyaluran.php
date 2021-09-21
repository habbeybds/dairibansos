<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyaluran extends Model
{
    //use HasFactory;
    protected $table = 'penyalurans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'penerima_id',
        'nik',
        'barang',
        'img',
        'tgl_penyaluran',
        'status',
    ];

    public function getListData()
    {
        return $this->select('penyalurans.*', 'p.name', 'k.kecamatan', 'd.desa', 'jb.jenis_bantuan','sk.nomor_sk', 'sk.tahapan')
            ->join('penerimas as p', 'p.id', '=', 'penyalurans.penerima_id')
            ->join('desas as d', 'd.id', '=', 'p.desaid')
            ->join('kecamatans as k', 'k.id', '=', 'd.kecamatanid')
            ->join('jenis_bantuans as jb', 'jb.id', '=', 'p.jenisbantuanid')
            ->join('nomor_sks as sk', 'sk.id', '=', 'p.no_skid')
            ->orderBy('penyalurans.id', 'DESC')->get();
    }

}
