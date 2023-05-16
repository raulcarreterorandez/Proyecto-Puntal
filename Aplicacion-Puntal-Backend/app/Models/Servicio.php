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
        'timeStampInicio' => 'required',
        'timeStampFinal' => 'required',
        'abonado' => 'required',
    ];

    protected $perPage = 20; //No recuerdo para que era

    protected $fillable = [
        'matriculaEmbarcacion', 
        'tipoServicio', 
        'precioHora', 
        'timeStampInicio', 
        'timeStampFinal', 
        'abonado'];

    public function embarcacion() {

        return $this->hasOne('App\Models\Embarcacione', 'matricula', 'matriculaEmbarcacion');
    }
}
