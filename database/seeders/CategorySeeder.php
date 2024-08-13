<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class CategorySeeder extends Seeder
{
    use Importable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(
            new class implements ToModel
            {
                public function model(array $row)
                {
                    if (!is_numeric($row[0])) return null;

                    Category::updateOrCreate([
                        'id' => $row[0]
                    ], [
                        'id' => $row[0],
                        'name' => $row[1],
                        'slug' => str_replace(' ', '-', strtolower($row[1])),
                        'url_image' => 'images/img/',
                        'name_image' => 'noimagen.jpg',
                        'destacar' => false,
                        'fit' => 'contain'
                    ]);
                }
            },
            'storage/app/utils/Categories.xlsx'
        );
    }
}
