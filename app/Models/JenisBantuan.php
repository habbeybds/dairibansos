<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBantuan extends Model
{
    //use HasFactory;
    protected $table = 'jenis_bantuans';
    protected $primaryKey = 'id';
    protected $fillable = ['jenis_bantuan','jumlah_tahapan','tahun_tahapan','status'];

    public function getListData()
    {
        return $this->orderBy('id', 'DESC')->get();
    }

}
