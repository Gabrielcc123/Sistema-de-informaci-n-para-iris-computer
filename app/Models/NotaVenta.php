<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaVenta extends Model
{
    use HasFactory;

    protected $table = 'notaVenta';
    protected $primaryKey = 'nroNotaVenta';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'idCliente',
        'idPago',
        'idAssesor',
        'fecha',
        'total'
    ];

    // Relación Inversa: Una Nota de Venta pertenece a un Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente', 'idCliente');
    }

    // Relación Inversa: Una Nota de Venta tiene una Modalidad de Pago
    public function pago()
    {
        return $this->belongsTo(Pago::class, 'idPago', 'idPago');
    }

    // Relación Inversa: Una Nota de Venta fue emitida por un Asesor (Usuario)
    public function asesor()
    {
        return $this->belongsTo(Usuario::class, 'idAssesor', 'idUsuario');
    }

    // Relación Uno a Muchos: Una Nota de Venta posee muchos renglones de detalle
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'idNotaVenta', 'nroNotaVenta');
    }
}