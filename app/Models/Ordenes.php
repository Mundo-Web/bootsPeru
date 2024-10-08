<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    use HasFactory;
    protected $fillable = [

        'codigo_orden',
        'monto',
        'precio_envio',
        'status_id',
        'usuario_id',
        'address_id',
        'points',
        'numero_tarjeta',
        'culqi_data',
        'address_full',
        'address_owner',
        'address_zipcode',
        'address_latitude',
        'address_longitude',
        'address_data',
        'billing_type',
        'billing_document',
        'billing_name',
        'billing_address',
        'billing_email',
        'consumer_phone',
        'dedication_id',
        'dedication_title',
        'dedication_message',
        'dedication_sign',
        'dedication_image',
        'fechaenvio',
        'horario_envio',
        'to',
        'from',
        'img_transferencia',
        'puntos_calculados'
    ];

    public function DetalleOrden()
    {
        return $this->hasMany(DetalleOrden::class, 'orden_id');
    }
   /*  public function statusOrdenes()
    {
        return $this->belongsTo(StatusOrden::class, 'status_id');
    } */

    public function statusOrdenes()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function usuarioPedido()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /* public function horarioEnvio()
    {
        return $this->belongsTo(Horarios::class, 'horario_envio');
    } */
}
