<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_orden');
            $table->string('monto');
            $table->string('precio_envio');
            $table->string('tipo_tarjeta')->nullable();

            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();

            $table->integer('points')->default(0);
            $table->string('numero_tarjeta')->nullable();
            $table->longText('culqi_data')->nullable();
            $table->longText('address_full')->nullable();
            $table->string('address_owner')->nullable();
            $table->string('address_zipcode');
            $table->decimal('address_latitude', 16, 10);
            $table->decimal('address_longitude', 16, 10);
            $table->longText('address_data')->nullable();
            $table->string('billing_type')->nullable();
            $table->string('billing_document')->nullable();
            $table->string('billing_name')->nullable();
            $table->longText('billing_address')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('consumer_phone')->nullable();
            $table->string('dedication_id')->nullable();
            $table->string('dedication_title')->nullable();
            $table->longText('dedication_message')->nullable();
            $table->string('dedication_sign')->nullable();
            $table->string('dedication_image')->nullable();

            $table->string('to')->nullable();
            $table->string('from')->nullable();
$table -> string('img_transferencia') -> nullable();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('usuario_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
