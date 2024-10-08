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
        Schema::table('ordenes', function (Blueprint $table) {
            //
            $table->dropColumn(['address_zipcode']);
            $table->dropColumn(['address_latitude']);
            $table->dropColumn(['address_longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordenes', function (Blueprint $table) {
            //
            $table->string('address_zipcode');
            $table->decimal('address_latitude', 16, 10);
            $table->decimal('address_longitude', 16, 10);
        });
    }
};
