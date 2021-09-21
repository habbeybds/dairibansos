<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    // use HasFactory;
    protected $table = 'kecamatans';
    protected $primaryKey = 'id';
    protected $fillable = ['kecamatan'];

    public function Desa()
    {
        return $this->hasMany(Desa::class);
    }

    public function getListData()
    {
        return $this->orderBy('id', 'ASC')->get();
    }

}
