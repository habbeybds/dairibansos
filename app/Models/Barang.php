<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    // use HasFactory;
    protected $table = 'barangs';
    protected $primaryKey = 'id';
    protected $fillable = ['agen_id', 'kode_barang', 'nama_barang', 'satuan', 'harga', 'stok', 'status'];


    public function getListData()
    {
        return $this->select('barangs.*', 'u.id as userid', 'u.first_name', 'u.last_name')
            ->join('users as u', 'u.id', '=', 'barangs.agen_id')
            ->orderBy('barangs.id', 'DESC')->get();
    }
    public function getListDataByAgenID($agenid)
    {
        return $this->select('barangs.*', 'u.id as userid', 'u.first_name', 'u.last_name')
            ->where('barangs.agen_id', $agenid)
            ->join('users as u', 'u.id', '=', 'barangs.agen_id')
            ->orderBy('barangs.id', 'DESC')->get();
    }


    public function getListDataPending()
    {
        return $this->select('barangs.*', 'u.id as userid', 'u.first_name', 'u.last_name')
            ->where('barangs.status', 'pending')
            ->where('barangs.status', '!=', 'cancelled')
            ->join('users as u', 'u.id', '=', 'barangs.agen_id')
            ->orderBy('barangs.id', 'DESC')->get();
    }

    public function getListDataApproved()
    {
        return $this->select('barangs.*', 'u.id as userid', 'u.first_name', 'u.last_name')
            ->where('barangs.status', 'approved')
            ->join('users as u', 'u.id', '=', 'barangs.agen_id')
            ->orderBy('barangs.id', 'DESC')->get();
    }
    public function getOneDataApproved($barangid)
    {
        return $this->select('barangs.*', 'u.id as userid', 'u.first_name', 'u.last_name')
            ->where('barangs.id', $barangid)
            ->where('barangs.status', 'approved')
            ->join('users as u', 'u.id', '=', 'barangs.agen_id')
            ->orderBy('barangs.id', 'DESC')->get();
    }
    public function getOneDataCancelled($barangid)
    {
        return $this->select('barangs.*', 'u.id as userid', 'u.first_name', 'u.last_name')
            ->where('barangs.id', $barangid)
            ->where('barangs.status', 'cancelled')
            ->join('users as u', 'u.id', '=', 'barangs.agen_id')
            ->orderBy('barangs.id', 'DESC')->get();
    }

    public function CheckDataBarangExist($params)
    {
        return DB::select("select * from `barangs` where (`kode_barang` = '".$params['kode_barang']."' or `nama_barang` = '".$params['nama_barang']."') and `agen_id` = ".$params['agen_id']." and `id` != ".$params['id']."");

    }
}
