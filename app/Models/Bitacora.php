<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'bitacora';
    protected $primaryKey = 'idBitacora';

    public $incrementing = true;
    protected $keyType = 'int';

    // Desactivamos los timestamps automáticos de Laravel
    public $timestamps = false;

    protected $fillable = [
        'idUsuario',
        'accion',
        'ip',
        'fecha',
        'hora'
    ];

    /**
     * Relación Inversa: Una bitácora pertenece a un Usuario específico
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario', 'idUsuario');
    }
}