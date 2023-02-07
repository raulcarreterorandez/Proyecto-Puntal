<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mensaje
 *
 * @property $id
 * @property $texto
 * @property $fecha_hora
 * @property $leido
 * @property $idUsuarioOrigen
 * @property $idUsuarioDestino
 *
 * @property Usuario $usuario
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Mensaje extends Model
{

    protected $primaryKey = "id";
    public $timestamps = false;

    static $rules = [
		'texto' => 'required',
		'fecha_hora' => 'required',
		'leido' => 'required',
		'idUsuarioOrigen' => 'required',
		'idUsuarioDestino' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'texto',
        'fecha_hora',
        'leido',
        'idUsuarioOrigen',
        'idUsuarioDestino'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuarioDestino()
    {
        return $this->hasOne('App\Models\Usuario', 'email', 'idUsuarioDestino');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuarioOrigen()
    {
        return $this->hasOne('App\Models\Usuario', 'email', 'idUsuarioOrigen');
    }


}
