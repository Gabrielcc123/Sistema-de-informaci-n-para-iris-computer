<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Permite usarlo para Auth de Laravel
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre',
        'apellido',
        'password',
        'telefono',
        'estado',
        'tipoAssesor',
        'tipoSupervisor',
        'tipoTecnico'
    ];

    // Oculta la contraseña por seguridad en las consultas
    protected $hidden = [
        'password',
    ];

    /**
     * Relación Uno a Muchos con Bitácora
     */
    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class, 'idUsuario', 'idUsuario');
    }
}
