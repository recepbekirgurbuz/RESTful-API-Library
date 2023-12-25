<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'recep',
            'surname' => 'gurbuz',
            'tel' => '05132890123',
            'address' => 'Istanbul Pendik',
            'email' => 'recep@mail.com',
            'password' => 'recep123',
        ]);

        User::create([
            'name' => 'bekir',
            'surname' => 'gurbuz',
            'tel' => '05132312299',
            'address' => 'Istanbul Maltepe',
            'email' => 'bekir@mail.com',
            'password' => 'bekir123',
        ]);
    }
}
