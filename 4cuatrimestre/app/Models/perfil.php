<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Perfil extends Model

{
    use HasFactory;

    protected $table = "perfil";

    //Definimos el primary key de la tabla
    protected $primaryKey = "idperfil";

    protected $fillable=[
        'nombre_perfil'
    ];

    public $timestamps = false;

    //public function Login():BelongsTo
    //{
      //  return $this->belongsTo(Login::class);
    //}
     // Relación con Login (un Perfil tiene muchos Login)
     public function logins(): HasMany
     {
         return $this->hasMany(Login::class, 'funcion', 'idperfil');
     }

     
    
     



}