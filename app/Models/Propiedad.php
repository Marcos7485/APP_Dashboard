<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;
    protected $table = 'proprietarios';

    protected $fillable = [
        'Contribuinte',
        'Nome',
        'Documento',
        'Imoveis',
        'Id_imov',
        'Enderecos',
        // Agrega aquí otros campos que deseas que sean asignables masivamente
    ];

    
}
