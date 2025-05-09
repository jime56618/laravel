<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PeriodoPromocion extends Model

{
    use HasFactory;

    protected $table = "periodo_promociones";

    //Definimos el primary key de la tabla
    protected $primaryKey = "id";

    protected $fillable=[
        'nombre_promocion',
        'porcentaje_descuento',
        'fecha_inicio',
        'fecha_fin'
        
    ];

    public $timestamps = false;


    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'datetime',
            'fecha_fin' => 'hashed',
        ];
    }




    
    


  


}