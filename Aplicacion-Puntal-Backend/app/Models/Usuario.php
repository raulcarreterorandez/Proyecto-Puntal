<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = "email";
    public $timestamps = false;

    protected $casts = [
		'email' => 'string',
        'instalaciones' => 'array'
	];

    protected $hidden = ['password'];

    protected $fillable = [
        'nombreUsuario',
        'password',
        'nombreCompleto',
        'email',
        'habilitado',
        'perfil',
        'idioma',
        'visto',
        'instalaciones'
    ];

    public function instalacionesUsuario()
    {
        return $this->belongsToMany(Instalacion::class, 'instalacionesUsuarios',"idUsuario", "idInstalacion");
    }

    public function mensajes()
    {
        return $this->hasMany('App\Models\Mensaje', 'idUsuarioDestino', 'email');
    }

}
