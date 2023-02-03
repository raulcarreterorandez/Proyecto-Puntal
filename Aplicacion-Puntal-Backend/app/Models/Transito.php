<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transito
 *
 * @property $idPlaza
 * @property $fechaEntrada
 * @property $fechaSalida
 *
 * @property Plaza $plaza
 * @property Tripulante[] $tripulantes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Transito extends Model
{
    
    static $rules = [
		'idPlaza' => 'required',
		'fechaEntrada' => 'required',
		'fechaSalida' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['idPlaza','fechaEntrada','fechaSalida'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function plaza()
    {
        return $this->hasOne('App\Models\Plaza', 'id', 'idPlaza');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tripulantes()
    {
        return $this->hasMany('App\Models\Tripulante', 'id_plaza', 'idPlaza');
    }
    

}
