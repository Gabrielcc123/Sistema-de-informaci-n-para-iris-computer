<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'orden';
    protected $primaryKey = 'idOrden';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'idEquipo',
        'idNotaVenta',
        'idTecnico',
        'descripcion',
        'estado'
    ];

    // Relación Inversa: Una orden técnica pertenece a un Equipo específico
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'idEquipo', 'idEquipo');
    }

    // Relación Inversa: Una orden se vincula a una Nota de Venta de servicios
    public function notaVenta()
    {
        return $this->belongsTo(NotaVenta::class, 'idNotaVenta', 'nroNotaVenta');
    }

    // Relación Inversa: Una orden es atendida por un Técnico (Usuario)
    public function tecnico()
    {
        return $this->belongsTo(Usuario::class, 'idTecnico', 'idUsuario');
    }
}
