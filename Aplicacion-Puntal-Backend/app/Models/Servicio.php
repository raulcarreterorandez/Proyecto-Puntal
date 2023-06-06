<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model {

    public $timestamps = false;
    protected $table = 'servicios';

    static $rules = [
        'matriculaEmbarcacion' => 'required',
        'tipoServicio' => 'required',
        'precioHora' => 'required',
        'abonado' => 'required',
        'finalizado' => 'required',
        'numHoras' => 'required|numeric|min:1',
        /* 'numHoras' => 'required', */
        'fechaSolicitud' => 'required',
    ];
    

    protected $perPage = 20; //No recuerdo para que era

    protected $fillable = [
        'matriculaEmbarcacion', 
        'tipoServicio', 
        'precioHora', 
        'abonado',
        'finalizado',
        'numHoras', 
        'fechaSolicitud'
    ];

    public function embarcacion() {

        return $this->hasOne('App\Models\Embarcacione', 'matricula', 'matriculaEmbarcacion');
    }
}
