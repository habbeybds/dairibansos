<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    // use HasFactory;
    protected $table = 'desas';
    protected $primaryKey = 'id';
    protected $fillable = ['kecamatanid','desa','status'];

    public function Kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function getListData()
    {
        return $this->select('desas.*', 'k.kecamatan')->join('kecamatans as k', 'k.id', '=', 'desas.kecamatanid')->orderBy('desas.id', 'DESC')->get();
    }

    
    public function getListDesaByKecamatanID($id)
    {
        return $this->where('kecamatanid',$id)
                    ->orderBy('id', 'ASC')->get();
    }
}