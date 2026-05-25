<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalleVenta';
    
    // Al ser una PK compuesta, desactivamos el incremento automático único
    public $incrementing = false;
    protected $primaryKey = null; 

    public $timestamps = false;

    protected $fillable = [
        'idNotaVenta',
        'idProductoServicio',
        'cantidad',
        'precioUnitario',
        'subTotal'
    ];

    /**
     * Relación Inversa: Un renglón de detalle pertenece a una Nota de Venta cabecera
     */
    public function notaVenta()
    {
        return $this->belongsTo(NotaVenta::class, 'idNotaVenta', 'nroNotaVenta');
    }

    /**
     * Relación Inversa: Un detalle hace referencia a un ítem del catálogo (Producto o Servicio)
     */
    public function productoServicio()
    {
        return $this->belongsTo(ProductoServicio::class, 'idProductoServicio', 'idProductoServicio');
    }
}
