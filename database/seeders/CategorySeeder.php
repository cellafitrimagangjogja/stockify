<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
                'name' => 'Elektronik',
                'description' => 'Ukuran (14 inci, 15,6 inci, 24 inci), Warna (Hitam, Putih, Silver), Berat (500 gram - 3 kg)'
        ]);

        Category::create([
                'name' => 'Accecories Komputer',
                'description' => 'Warna (Hitam, Putih, Abu-abu), Berat (50 gram - 500 gram)'
        ]);

        Category::create([
                'name' => 'Penyimpanan Data',
                'description' => 'Ukuran (2,5 inci, 3,5 inci), Warna (Hitam, Silver), Berat (20 gram - 700 gram)'
        ]);
    }
}
