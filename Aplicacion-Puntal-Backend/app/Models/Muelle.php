<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Muelle extends Model
{

    public $timestamps = false;

    static $rules = [
        'idInstalacion' => 'required',
        'visto' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['idInstalacion', 'visto'];

    public function instalacion()
    {
        return $this->hasOne('App\Models\Instalacion', 'id', 'idInstalacion');
    }

    public function plazas()
    {
        return $this->hasMany('App\Models\Plaza', 'idMuelle', 'id');
    }
}
