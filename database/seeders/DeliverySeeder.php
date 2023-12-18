<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Delivery;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Delivery::create([
            'book_id' => 1,
            'user_id' => 2,
            'point' => 5,
            'status' => 'false',
            'delivery_date' => '2023-12-28',
        ]);

        Delivery::create([
            'book_id' => 3,
            'user_id' => 2,
            'point' => 4,
            'status' => 'true',
            'delivery_date' => '2023-12-08',
        ]);

        Delivery::create([
            'book_id' => 2,
            'user_id' => 1,
            'point' => 3,
            'status' => 'true',
            'delivery_date' => '2023-12-08',
        ]);
    }
}
