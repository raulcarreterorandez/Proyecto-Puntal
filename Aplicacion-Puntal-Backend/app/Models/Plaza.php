<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Plaza extends Model {

    public $timestamps = false;

    static $rules = [
        'disponible' => 'required',
        'visto' => 'required',
        'año' => 'required',
        'idMuelle' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['disponible', 'visto', 'puertoOrigen', 'puertoDestino', 'año', 'idMuelle'];

    public function bases() {
        return $this->hasOne('App\Models\Bases', 'idPlaza', 'id');
    }

    public function embarcaciones() {
        return $this->hasMany('App\Models\Embarcacion', 'id_plaza', 'id');
    }

    public function muelle() {
        return $this->hasOne('App\Models\Muelle', 'id', 'idMuelle');
    }

    public function transito() {
        return $this->hasOne('App\Models\Transito', 'idPlaza', 'id');
    }
}
