<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',       // <-- AGREGAR AQUÍ
        'password',
        'telefono',
        'estado',
        'tipoAssesor',
        'tipoSupervisor',
        'tipoTecnico',
    ];

    protected $hidden = [
        'password',
    ];
}