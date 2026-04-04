<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipio';
    protected $primaryKey = 'id_municipio';
    public $timestamps = false;

    protected $fillable = [
        'nombre_municipio'
    ];

    public function colonias()
    {
        return $this->hasMany(Colonia::class,'id_municipio');
    }
}