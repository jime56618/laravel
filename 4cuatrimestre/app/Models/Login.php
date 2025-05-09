<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Login extends Model
{
    use HasFactory;


      //Definimos que tabla es de la base de datos
      protected $table = "usuarios";

      //Definimos el primary key de la tabla
      protected $primaryKey = "id";
  
      //Dehabilitar los campos de created_at y update_at
      public $timestamps = false;
  
      //Definimos las demas columnas que tenemos en la tabla
      protected $fillable = [
          'nombre',
          "password",
          "funcion"
      ];

         // Relación con Perfil (cada Login "pertenece a" un Perfil)
         public function perfil(): BelongsTo
         {
             return $this->belongsTo(Perfil::class, 'funcion', 'idperfil');
         }


          // Relación con Compras
    public function compras(): HasMany
    {
        return $this->hasMany(Compras::class, 'id_usuario', 'id');
    }

}
