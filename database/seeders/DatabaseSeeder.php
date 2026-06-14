<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cafe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Admin CaféRate',
            'email'    => 'admin@caferate.com',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Sample user
        User::create([
            'name'     => 'User Demo',
            'email'    => 'user@caferate.com',
            'password' => Hash::make('user123'),
            'role'     => 'user',
        ]);

        // Sample cafes
        $cafes = [
            [
                'name'            => 'Kopi Kenangan Banda Aceh',
                'address'         => 'Jl. Sudirman No. 10',
                'city'            => 'Banda Aceh',
                'description'     => 'Café hits dengan menu kopi kekinian, WiFi stabil, dan banyak colokan. Cocok buat kerja atau ngobrol santai.',
                'wifi_quality'    => 'good',
                'power_outlet'    => 'many',
                'noise_level'     => 'moderate',
                'price_range_min' => 15000,
                'price_range_max' => 45000,
                'status'          => 'active',
            ],
            [
                'name'            => 'Warung Kopi Solong',
                'address'         => 'Jl. Cut Meutia No. 4',
                'city'            => 'Banda Aceh',
                'description'     => 'Warung kopi legendaris Aceh sejak 1975. Kopi saring autentik dan suasana khas Aceh.',
                'wifi_quality'    => 'medium',
                'power_outlet'    => 'few',
                'noise_level'     => 'noisy',
                'price_range_min' => 5000,
                'price_range_max' => 20000,
                'status'          => 'active',
            ],
            [
                'name'            => 'Café Nongkrong Asik',
                'address'         => 'Jl. T. Nyak Arief No. 22',
                'city'            => 'Banda Aceh',
                'description'     => 'Café dengan konsep industrial, musik lo-fi, dan minuman kekinian. Pas buat remote working.',
                'wifi_quality'    => 'good',
                'power_outlet'    => 'many',
                'noise_level'     => 'quiet',
                'price_range_min' => 20000,
                'price_range_max' => 60000,
                'status'          => 'active',
            ],
            [
                'name'            => 'Rumah Kopi Ulee Kareng',
                'address'         => 'Jl. Ulee Kareng No. 5',
                'city'            => 'Banda Aceh',
                'description'     => 'Kopi robusta Gayo asli dengan harga terjangkau. Spot favorit mahasiswa.',
                'wifi_quality'    => 'medium',
                'power_outlet'    => 'few',
                'noise_level'     => 'moderate',
                'price_range_min' => 8000,
                'price_range_max' => 25000,
                'status'          => 'active',
            ],
            [
                'name'            => 'The Workspace Café',
                'address'         => 'Jl. Tgk. Daud Beureueh No. 18',
                'city'            => 'Banda Aceh',
                'description'     => 'Co-working café dengan meja luas, WiFi super cepat, dan private booth untuk meeting.',
                'wifi_quality'    => 'good',
                'power_outlet'    => 'many',
                'noise_level'     => 'quiet',
                'price_range_min' => 25000,
                'price_range_max' => 75000,
                'status'          => 'active',
            ],
        ];

        foreach ($cafes as $cafe) {
            Cafe::create($cafe);
        }
    }
}
