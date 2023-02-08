<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $primaryKey = 'numDocumento';
    protected $casts = [
        'numDocumento' => 'string',
        'telefono' => 'string'
    ];
    public $timestamps = false;

    static $rules = [
        'numDocumento' => 'required',
        'nombre' => 'required',
        'apellidos' => 'required',
        'email' => 'required',
        'direccion' => 'required',
        'tipoDocumento' => 'required',
        'observaciones' => 'required'
    ];

    protected $perPage = 20;

    protected $fillable = [
        'numDocumento', 'nombre', 'apellidos', 'email', 'direccion', 'tipoDocumento', 'observaciones'
    ];

    public function embarcaciones()
    {
        return $this->hasMany('App\Models\Embarcacione', 'id_cliente', 'numDocumento');
    }

    public function telefonos()
    {
        return $this->hasMany('App\Models\Telefono', 'idCliente', 'numDocumento');
    }
}
