<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->insert([
            'distrito_id' => 150122,
            'price' => 10,
            'status' => 1,
            'visble' => 1,
            'local' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}