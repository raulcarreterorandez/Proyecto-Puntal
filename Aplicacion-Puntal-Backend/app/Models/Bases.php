<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bases extends Model {

  protected $primaryKey = "idPlaza";
  protected $table = 'bases';
  public $timestamps = false;

  static $rules = [
    'idPlaza' => 'required',
    'fechaEntrada' => 'required',
    'fechaSalida' => 'required',
  ];

  protected $perPage = 20;

  protected $fillable = ['idPlaza', 'fechaEntrada', 'fechaSalida'];

  public function plaza() {

    return $this->hasOne('App\Models\Plaza', 'id', 'idPlaza');
}

  public function muelle() {

    return $this->hasOneThrough(
      Muelle::class,
      Plaza::class,
      'idMuelle',
      'id'
    );
    // La relación "hasOneThrough()" «tiene-uno-a-través-de» vincula los modelos a través de una única relación intermedia.
    // Por ejemplo, si cada proveedor (supplier) tiene un usuario (user) y cada usuario está asociado con un 
    // registro del historial (history) de usuarios, entonces el modelo del proveedor puede acceder al historial 
    // del usuario a través del usuario.
    // El primer argumento pasado al método hasOneThrough es el nombre del modelo final al que queremos acceder
    // El segundo argumento mientras que el segundo argumento es el nombre del modelo intermedio.
    // El tercer argumento es el nombre de la clave externa en el modelo intermedio. 
    // El cuarto argumento es el nombre de la clave externa en el modelo final. 
    // El quinto argumento es la clave local, mientras que el sexto argumento es la clave local del modelo intermedio.       
  }
}
