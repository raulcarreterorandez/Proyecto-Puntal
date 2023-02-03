<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Plaza
 *
 * @property $id
 * @property $disponible
 * @property $visto
 * @property $puertoOrigen
 * @property $puertoDestino
 * @property $año
 * @property $idMuelle
 *
 * @property Basis $basis
 * @property Embarcacione[] $embarcaciones
 * @property Muelle $muelle
 * @property Transito $transito
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Plaza extends Model
{
    
    static $rules = [
		'disponible' => 'required',
		'visto' => 'required',
		'año' => 'required',
		'idMuelle' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['disponible','visto','puertoOrigen','puertoDestino','año','idMuelle'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function basis()
    {
        return $this->hasOne('App\Models\Basis', 'idPlaza', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function embarcaciones()
    {
        return $this->hasMany('App\Models\Embarcacione', 'id_plaza', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function muelle()
    {
        return $this->hasOne('App\Models\Muelle', 'id', 'idMuelle');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transito()
    {
        return $this->hasOne('App\Models\Transito', 'idPlaza', 'id');
    }
    

}
