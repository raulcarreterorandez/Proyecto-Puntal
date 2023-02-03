<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Muelle
 *
 * @property $id
 * @property $idInstalacion
 * @property $visto
 *
 * @property Instalacione $instalacione
 * @property Plaza[] $plazas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Muelle extends Model
{
    
    static $rules = [
		'idInstalacion' => 'required',
		'visto' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['idInstalacion','visto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function instalacione()
    {
        return $this->hasOne('App\Models\Instalacione', 'id', 'idInstalacion');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plazas()
    {
        return $this->hasMany('App\Models\Plaza', 'idMuelle', 'id');
    }
    

}
