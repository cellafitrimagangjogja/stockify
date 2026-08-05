<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
                'name' => 'Adi Saputra',
                'address' => 'Jln. Mawar, Ds. Sukorame, Kec. Sukomoro, Kab.Nganjuk',
                'phone' => '081266779945',
                'email' => 'adi@gamil.com'
            ]);

        Supplier::create([
                'name' => 'Aris Kurniawan',
                'address' => 'Jln. letnan Suprapto, Ds. Patranrejo, Kec. Berbek, Kab.Nganjuk',
                'phone' => '081296777944',
                'email' => 'aris@gamil.com'
            ]);
        Supplier::create([
            
                'name' => 'Reka Cahyo',
                'address' => 'Jln. A.R Saleh, Ds. Kauman, Kec. Nganjuk, Kab.Nganjuk',
                'phone' => '081769778925',
                'email' => 'reka@gamil.com'
            ]);
    }
}
