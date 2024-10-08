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
        Schema::table('detalle_ordens', function (Blueprint $table) {
            $table->integer('points')->default(0);
            $table->decimal('price_used')->default(0);
            $table->integer('points_used')->default(0);
            $table->string('name');
            $table->string('imagen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_ordens', function (Blueprint $table) {
            $table->dropColumn([
                'points',
                'price_used',
                'points_used',
                'name',
                'imagen',
            ]);
        });
    }
};
