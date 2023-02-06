<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Transito extends Model {

    protected $primaryKey = "idPlaza";
    public $timestamps = false;

    static $rules = [
        'idPlaza' => 'required',
        'fechaEntrada' => 'required',
        'fechaSalida' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['idPlaza', 'fechaEntrada', 'fechaSalida'];

    public function plaza() {

        return $this->hasOne('App\Models\Plaza', 'id', 'idPlaza');
    }

    public function tripulantes() {

        return $this->hasMany('App\Models\Tripulante', 'id_plaza', 'idPlaza');
    }
}
