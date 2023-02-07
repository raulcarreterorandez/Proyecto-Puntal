<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $primaryKey = 'numero';
    protected $casts = [
        'numero' => 'string',
    ];
    public $timestamps = false;

    static $rules = [
        'numero' => 'required',
        'idCliente' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['numero', 'idCliente'];

    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'numDocumento', 'idCliente');
    }
}
