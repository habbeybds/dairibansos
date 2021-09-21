<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penerima extends Model
{
    //use HasFactory;
    protected $table = 'penerimas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_skid',
        'nik',
        'no_kk',
        'name',
        'alamat',
        "desaid",
        'jenis_kelamin',
        "pekerjaan",
        'status_kawin',
        'dtks',
        'dtks2_kk',
        'jenisbantuanid',
        'nominal_bantuan',
        'no_hp',
        'tahapan',
        'jumlah_tahapan',
        'tahun_tahapan',
        'status',
    ];

    public function getListData()
    {
        return $this->select('penerimas.*', 'd.desa', 'sk.nomor_sk', 'jb.jenis_bantuan')
            ->join('desas as d', 'd.id', '=', 'penerimas.desaid')
            ->join('nomor_sks as sk', 'sk.id', '=', 'penerimas.no_skid')
            ->join('jenis_bantuans as jb', 'jb.id', '=', 'penerimas.jenisbantuanid')
            ->orderBy('penerimas.id', 'DESC')->get();
    }
    public function getListDataByKeywords($keyword)
    {   
        return DB::select('SELECT penerimas.* , d.desa, sk.nomor_sk ,jb.jenis_bantuan FROM `penerimas` INNER JOIN  `desas` as d ON d.id = penerimas.desaid INNER JOIN `nomor_sks` as sk ON sk.id = penerimas.no_skid INNER JOIN `jenis_bantuans` as jb ON jb.id = penerimas.jenisbantuanid WHERE ( penerimas.nik LIKE "%'.$keyword.'%" OR penerimas.name LIKE "%'.$keyword.'%" ) AND NOT EXISTS (SELECT * FROM `penyalurans` as py WHERE penerimas.id = py.penerima_id) ORDER BY penerimas.id DESC');
       
        
    }
    public function getOneData($req)
    {
        return $this->select('penerimas.*','d.desa', 'sk.nomor_sk', 'jb.jenis_bantuan')
            ->where('penerimas.name', $req->inputNamaPenerima)
            ->where('nik', $req->nik_penerima)
            ->join('desas as d', 'd.id', '=', 'penerimas.desaid')
            ->join('nomor_sks as sk', 'sk.id', '=', 'penerimas.no_skid')
            ->join('jenis_bantuans as jb', 'jb.id', '=', 'penerimas.jenisbantuanid')
            ->orderBy('penerimas.id', 'DESC')->get();
    }
}
