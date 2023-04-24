<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokHadiahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stok_hadiah')->insert([
            'barcode' => rand(1,20),
            'nama_barang' => 'Gelas',
            'qty' => 20,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
         ]);
         DB::table('stok_hadiah')->insert([
            'barcode' => rand(1,20),
            'nama_barang' => 'Mangkok',
            'qty' => 20,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
         ]);
    }
}
