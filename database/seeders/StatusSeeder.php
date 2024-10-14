<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::updateOrCreate([
            'name' => 'Creado' 
        ], [
            'name' => 'Creado',
            'color' => '#000000'
        ]);
        Status::updateOrCreate([
            'name' => 'Rechazado' 
        ], [
            'name' => 'Rechazado',
            'color' => '#ff0000'
        ]);
        Status::updateOrCreate([
            'name' => 'Pagado' 
        ], [
            'name' => 'Pagado',
            'color' => '#009431'
        ]);
        Status::updateOrCreate([
            'name' => 'Pagado - Entregado' 
        ], [
            'name' => 'Pagado - Entregado',
            'color' => '#009431'
        ]);
        Status::updateOrCreate([
            'name' => 'Pagado - Conforme' 
        ], [
            'name' => 'Pagado - Conforme',
            'color' => '#009431'
        ]);
        Status::updateOrCreate([
            'name' => 'Pagado - Por Validar' 
        ], [
            'name' => 'Pagado - Por Validar',
            'color' => '#000000'
        ]);
    }
}
