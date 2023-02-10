<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model {

    public $timestamps = false;
    protected $table = 'instalaciones';
   /*  protected $primaryKey = 'codigo'; */


    static $rules = [
        'codigo' => 'required',
        'nombrePuerto' => 'required',
        'estado' => 'required',
        'visto' => 'required',
        'fechaDisposicion' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['codigo', 'nombrePuerto', 'descripcion', 'estado', 'visto', 'fechaDisposicion'];

    public function instalacionesUsuarios() {
        return $this->hasMany('App\Models\InstalacionesUsuario', 'idInstalacion', 'id');
        // return $this->belongsToMany(Usuario::class, 'instalacionesUsuarios',"idUsuario", "idInstalacion");

    }

    public function muelles() {
        return $this->hasMany('App\Models\Muelle', 'idInstalacion', 'id');
    }
}
