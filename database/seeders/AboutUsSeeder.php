<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about_us')->insert([
            [
                'titulo' => 'MISION',
                'descripcion' => '<div class="prose"><p>Integer mollis pharetra mi, non congue elit pharetra id. Etiam aliquam non sem quis commodo. Vestibulum elementum ex et pretium eleifend. Pellentesque elit metus, tempus vel libero et, dictum lobortis augue. </p></div>',
                'imagen' => 'storage/images/imagen/fl85XXUtND_Ima2.png',
                'status' => 1,
                'created_at' => '2024-08-02 21:33:46',
                'updated_at' => '2024-08-02 23:57:40',
            ],
            [
                'titulo' => 'Maecenas fringilla magna vitae elit fringilla',
                'descripcion' => '<div class="prose"><p>Integer mollis pharetra mi, non congue elit pharetra id. Etiam aliquam non sem quis commodo. Vestibulum elementum ex et pretium eleifend. Pellentesque elit metus, tempus vel libero et, dictum lobortis augue. </p><p><br></p></div>',
                'imagen' => 'storage/images/imagen/i4pfzlPd8d_Ima2.png',
                'status' => 1,
                'created_at' => '2024-08-02 21:33:56',
                'updated_at' => '2024-08-03 00:22:01',
            ],
            [
                'titulo' => 'NUESTRA HISTORIA',
                'descripcion' => '<div class="prose"><p>Lorem ipsum odor amet, consectetuer adipiscing elit. Eget justo in pharetra, senectus ornare curabitur tristique duis. Ad aliquam est lectus egestas lacinia molestie feugiat ultrices est. Libero scelerisque senectus gravida purus velit mus venenatis sapien. Vitae facilisis posuere leo at nec cras at. Eleifend diam eros torquent ex amet. Vivamus auctor felis suspendisse, quam inceptos tellus suspendisse dignissim.</p><p><br></p><p>Nostra commodo risus hendrerit at, metus erat cubilia libero. Curae varius commodo adipiscing ante ex. Praesent semper massa eleifend blandit natoque sagittis. Urna proin scelerisque sodales aliquet habitant platea. Libero dui non nascetur; tincidunt est ornare scelerisque nec. Platea integer consectetur ante purus varius at ut scelerisque. Euismod parturient viverra taciti quisque suspendisse diam at, imperdiet maecenas. Sem posuere leo tincidunt magnis conubia per ac congue. Torquent morbi nunc lectus nam venenatis purus enim.</p><p><br></p><p>Praesent dapibus habitasse iaculis donec mattis enim malesuada non. Mattis metus purus per; aliquet tristique platea. Donec phasellus varius ut turpis leo tortor. Id nascetur potenti mollis vulputate iaculis mauris vehicula fames. Varius dui aliquam natoque risus in phasellus nam. Dignissim maximus dignissim; vivamus mi leo inceptos. Arcu curae maximus interdum donec pulvinar sed. Mollis litora fermentum scelerisque porttitor justo porttitor eros. Taciti tristique leo nunc suspendisse, ac quis.</p><p><br></p><p><br></p></div>',
                'imagen' => 'storage/images/imagen/0B2yAS5w0E_image 15.png',
                'status' => 1,
                'created_at' => '2024-08-02 21:34:50',
                'updated_at' => '2024-08-02 23:47:03',
            ],
            [
                'titulo' => 'Vision2',
                'descripcion' => '<div class="prose"><p>Integer mollis pharetra mi, non congue elit pharetra id. Etiam aliquam non sem quis commodo. Vestibulum elementum ex et pretium eleifend. Pellentesque elit metus, tempus vel libero et, dictum lobortis augue. </p></div>',
                'imagen' => null,
                'status' => 1,
                'created_at' => '2024-08-02 23:53:17',
                'updated_at' => '2024-08-02 23:54:04',
            ],
        ]);
    }
}
