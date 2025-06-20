<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Category;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada kategori terlebih dahulu
        $categories = Category::all();
        
        // Jika belum ada kategori, buat beberapa kategori dasar
        if ($categories->isEmpty()) {
            $categories = Category::insert([
                [
                    'name' => 'Makanan Berat', 
                    'description' => 'Menu makanan berat', 
                    'image' => 'category-makanan-berat.jpg'
                ],
                [
                    'name' => 'Minuman', 
                    'description' => 'Menu minuman', 
                    'image' => 'category-minuman.jpg'
                ],
                [
                    'name' => 'Camilan', 
                    'description' => 'Menu camilan', 
                    'image' => 'category-camilan.jpg'
                ],
                [
                    'name' => 'Porsi Kecil', 
                    'description' => 'Menu porsi kecil', 
                    'image' => 'category-porsi-kecil.jpg'
                ],
                [
                    'name' => 'Porsi Besar', 
                    'description' => 'Menu porsi besar', 
                    'image' => 'category-porsi-besar.jpg'
                ]
            ]);
            
            // Refresh categories setelah dibuat
            $categories = Category::all();
        }

        // Menu Makanan Berat
        Menu::create([
            'name' => 'Nasi Goreng Spesial',
            'description' => 'Nasi goreng dengan telur, ayam, dan sayuran',
            'price' => 35000,
            'image' => 'nasi-goreng.jpg'
        ]);

        Menu::create([
            'name' => 'Ayam Bakar Madu',
            'description' => 'Ayam bakar dengan saus madu khas',
            'price' => 45000,
            'image' => 'ayam-bakar.jpg'
        ]);

        // Menu Minuman
        Menu::create([
            'name' => 'Es Teh Manis',
            'description' => 'Teh manis dingin',
            'price' => 5000,
            'image' => 'es-teh.jpg'
        ]);

        Menu::create([
            'name' => 'Jus Alpukat',
            'description' => 'Jus alpukat segar',
            'price' => 15000,
            'image' => 'jus-alpukat.jpg'
        ]);

        // Menu Camilan
        Menu::create([
            'name' => 'Spring Roll',
            'description' => 'Spring roll dengan isi sayuran',
            'price' => 20000,
            'image' => 'spring-roll.jpg'
        ]);

        Menu::create([
            'name' => 'French Fries',
            'description' => 'French fries kentang',
            'price' => 15000,
            'image' => 'french-fries.jpg'
        ]);

        // Menu Porsi Besar
        Menu::create([
            'name' => 'Nasi Goreng Raksasa',
            'description' => 'Nasi goreng porsi besar untuk 2-3 orang',
            'price' => 60000,
            'image' => 'nasi-goreng-raksasa.jpg'
        ]);

        // Buat relasi antara menu dan kategori
        $menus = Menu::all();
        
        // Cek jumlah menu yang dibuat
        if (count($menus) !== 7) {
            throw new \Exception("Jumlah menu yang dibuat tidak sesuai. Harus ada 7 menu, tetapi hanya ada " . count($menus));
        }
        
        // Buat relasi menggunakan model relationship
        $menus[0]->categories()->attach($categories[0]); // Nasi Goreng Spesial -> Makanan Berat
        $menus[1]->categories()->attach($categories[0]); // Ayam Bakar Madu -> Makanan Berat
        $menus[2]->categories()->attach($categories[1]); // Es Teh Manis -> Minuman
        $menus[3]->categories()->attach($categories[1]); // Jus Alpukat -> Minuman
        $menus[4]->categories()->attach($categories[2]); // Spring Roll -> Camilan
        $menus[5]->categories()->attach($categories[3]); // French Fries -> Porsi Kecil
        $menus[6]->categories()->attach($categories[4]); // Nasi Goreng Raksasa -> Porsi Besar
    }
}
