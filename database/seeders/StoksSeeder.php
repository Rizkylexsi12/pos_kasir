<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stoks')->insert([
            'barcode' => rand(1,20),
            'nama_barang' => 'qwert',
            'harga_barang' => 40000,
            'harga_beli' => 50000,
            'qty' => 20,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
         ]);
 
         DB::table('stoks')->insert([
            'barcode' => rand(1,20),
            'nama_barang' => 'poquwpe',
            'harga_barang' => 25000,
            'harga_beli' => 50000,
            'qty' => 15,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
         ]);
         DB::table('stoks')->insert([
            'barcode' => rand(1,20),
            'nama_barang' => 'saasf',
            'harga_barang' => 40000,
            'harga_beli' => 50000,
            'qty' => 20,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
         ]);
 
         DB::table('stoks')->insert([
            'barcode' => rand(1,20),
            'nama_barang' => 'lkasda',
            'harga_barang' => 25000,
            'harga_beli' => 50000,
            'qty' => 15,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
         ]);
         DB::table('stoks')->insert([
            'barcode' => rand(1,20),
            'nama_barang' => 'sdfas',
            'harga_barang' => 40000,
            'harga_beli' => 50000,
            'qty' => 20,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
         ]);
 
         DB::table('stoks')->insert([
            'barcode' => rand(1,20),
            'nama_barang' => 'dgsd',
            'harga_barang' => 25000,
            'harga_beli' => 50000,
            'qty' => 15,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
         ]);
    }
}
