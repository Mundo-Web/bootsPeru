<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'lastname',
        'email',
        'phone',
        'address_department',
        'address_province',
        'address_district',
        'address_price',
        'address_street',
        'address_number',
        'address_description',
        'total',
        'status_code',
        'status_message',
        'doc_number',
        'razon_fact',
        'direccion_fact'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
