<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permiso extends Model

{
    use HasFactory;

    protected $table = "permiso";

    //Definimos el primary key de la tabla
    protected $primaryKey = "idpermiso";

    protected $fillable=[
        'nombre',
        'clave'
    ];

    public $timestamps = false;




    
    


  


}