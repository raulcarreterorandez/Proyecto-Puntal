<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tripulante extends Model
{
    protected $primaryKey = 'numDocumento';
    protected $casts = [
        'numDocumento' => 'string',
        'id_embarcacion' => 'string',
    ];

    public $timestamps = false;
    static $rules = [
        'numDocumento' => 'required',
        'nombre' => 'required',
        'apellidos' => 'required',
        'nacionalidad' => 'required',
        'fechaNacimiento' => 'required',
        'lugarNacimiento' => 'required',
        'paisNacimiento' => 'required',
        'tipoDocumento' => 'required',
        'fechaExpedicionDocumento' => 'required',
        'fechaCaducidadDocumento' => 'required',
        'id_plaza' => 'required',
        'id_embarcacion' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['numDocumento', 'nombre', 'apellidos', 'nacionalidad', 'fechaNacimiento', 'lugarNacimiento', 'paisNacimiento', 'tipoDocumento', 'fechaExpedicionDocumento', 'fechaCaducidadDocumento', 'id_plaza', 'id_embarcacion'];

    public function embarcacione()
    {
        return $this->belongsTo(Embarcacione::class, 'id_embarcacion');
    }

    public function transito()
    {
        return $this->belongsTo(Transito::class, 'idplaza');
    }
}
