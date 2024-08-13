<?php

namespace Database\Seeders;

use App\Models\PoliticaDatos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliticasDatos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PoliticaDatos::create([
            'title' => 'Política de Datos',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nunc nec',
            'finaltitle' => 'Política de Datos',
        ]);
    }
}
