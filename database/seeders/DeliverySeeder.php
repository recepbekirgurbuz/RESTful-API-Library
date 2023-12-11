<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserBook;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserBook::create([
            'book_id' => 1,
            'user_id' => 2,
            'point' => 5,
            'delivery_date' => '2023-12-28',
        ]);

        UserBook::create([
            'book_id' => 3,
            'user_id' => 2,
            'point' => 4,
            'delivery_date' => '2023-12-18',
        ]);

        UserBook::create([
            'book_id' => 2,
            'user_id' => 1,
            'point' => 3,
            'delivery_date' => '2023-12-8',
        ]);
    }
}