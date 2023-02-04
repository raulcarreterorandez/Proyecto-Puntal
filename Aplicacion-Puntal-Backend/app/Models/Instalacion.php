<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{
    public $timestamps = false;
    protected $table = 'instalaciones';


    static $rules = [
		'codigo' => 'required',
		'nombrePuerto' => 'required',
		'estado' => 'required',
		'visto' => 'required',
		'fechaDisposicion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['codigo','nombrePuerto','descripcion','estado','visto','fechaDisposicion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instalacionesUsuarios()
    {
        return $this->hasMany('App\Models\InstalacionesUsuario', 'idInstalacion', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function muelles()
    {
        return $this->hasMany('App\Models\Muelle', 'idInstalacion', 'id');
    }


}
