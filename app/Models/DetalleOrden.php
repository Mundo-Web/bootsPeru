<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    use HasFactory;
    protected $fillable = [
        'orden_id',
        'producto_id',
        'name',
        'imagen',
        'cantidad',
        'precio',
        'price_used',
        'points',
        'points_used',
    ];

    public function ordenes()
    {
        return $this->belongsTo(Ordenes::class, 'orden_id');
    }

    public function producto()
    {
        return $this->belongsTo(Products::class, 'producto_id');
    }
/* 
    public function imagenProducto()
    {
        return $this->hasOne(ImagenProducto::class, 'product_id', 'producto_id')->where('caratula', 1);
    } */
}
