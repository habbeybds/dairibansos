<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorSK extends Model
{
    //use HasFactory;
    protected $table = 'nomor_sks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nomor_sk',
        'jenisbantuanid',
        'tahapan',
    ];

    public function checkTahapanBySKJB($jenisbantuanid)
    {
        return $this->select('nomor_sks.*', 'jb.jenis_bantuan', 'jb.jumlah_tahapan', 'jb.tahun_tahapan')
                    ->join('jenis_bantuans as jb', 'jb.id', '=', 'nomor_sks.jenisbantuanid')
                    ->where('nomor_sks.jenisbantuanid' , $jenisbantuanid)
                    ->latest('tahapan')
                    ->first();
    }
    public function getListDatabyNoSK($nomorSK, $jenisbantuanid)
    {
        return $this->where('nomor_sks.jenisbantuanid' , $jenisbantuanid)
                    ->where('nomor_sks.nomor_sk' , $nomorSK)
                    ->orderBy('nomor_sks.id', 'DESC')
                    ->get();
    }
}
