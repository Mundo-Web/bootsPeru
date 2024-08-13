<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\SubCategory;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class SubcategorySeeder extends Seeder
{
    use Importable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new class implements ToModel
        {
            public function model(array $row)
            {
                if (!is_numeric($row[0])) return null;

                $category = Category::updateOrCreate(['id' => $row[1]], [
                    'id' => $row[1],
                    'name' => $row[2],
                    'slug' => str_replace(' ', '-', strtolower($row[2])),
                    'url_image' => 'images/img/',
                    'name_image' => 'noimagen.jpg'
                ]);

                SubCategory::updateOrCreate(['id' => $row[0]], [
                    'id' => $row[0],
                    'category_id' => $category->id,
                    'name' => $row[3],
                    'slug' => str_replace(' ', '-', strtolower($row[3])),
                    'status' => true,
                    'visible' => true
                ]);
            }
        }, 'storage/app/utils/SubCategories.xlsx');
    }
}
