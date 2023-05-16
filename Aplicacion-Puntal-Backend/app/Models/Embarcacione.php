<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Embarcacione extends Model
{

    protected $primaryKey = 'matricula';
    protected $casts = [
        'matricula' => 'string'
    ];
    public $timestamps = false;

    static $rules = [
        'matricula' => 'required',
        'nombre' => 'required',
        'eslora' => 'required',
        'manga' => 'required',
        'calado' => 'required',
        'propulsion' => 'required',
        'id_cliente' => 'required',
        'id_plaza' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = [
        'matricula',
        'nombre',
        'eslora',
        'manga',
        'calado',
        'propulsion',
        'id_cliente',
        'id_plaza'
    ];

    public function cliente() {
        return $this->hasOne('App\Models\Cliente', 'numDocumento', 'id_cliente');
    }

    public function plaza() {
        return $this->hasOne('App\Models\Plaza', 'id', 'id_plaza');
    }

    public function tripulantes() {
        return $this->hasMany('App\Models\Tripulante', 'id_embarcacion', 'matricula');
    }

    public function servicios() {
        return $this->hasMany('App\Models\Servicio', 'matriculaEmbarcacion', 'matricula');
    }
}
