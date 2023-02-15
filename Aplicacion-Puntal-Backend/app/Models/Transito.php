<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transito extends Model {

    // El generador de CRUD automático da ciertos problemas. Necesitamos en algunos casos:
    protected $primaryKey = "idPlaza"; // Especificar la clave primaria, si no coge id a secas por defecto.
    protected $table = 'transitos'; // Especificar el nombre de la tabla. Añade o quita 's' a los nombres.
    public $timestamps = false; // Si no queremos agregar los campos updated_at/created_at a todas nuestras tablas.
    // Otras soluciones: Debe declarar public $timestamps = false; en cada modelo o crear un BaseModel, definirlo 
    // allí y hacer que todos sus modelos lo extiendan en lugar de ser elocuentes. Solo tenga en cuenta que las 
    // tablas dinámicas DEBEN tener marcas de tiempo si está usando Eloquent.
    // Actualización: tenga en cuenta que las marcas de tiempo ya no son OBLIGATORIAS en las tablas dinámicas después
    // de Laravel v3(actualmente Laravel Framework 9.50.2).
    // Actualización: también puede deshabilitar las marcas de tiempo eliminándolas $table->timestamps()de su migración.


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

    public function tripulantes() {

        return $this->hasMany('App\Models\Tripulante', 'id_plaza', 'idPlaza');
    }

    public function muelle(){

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
