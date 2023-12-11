<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'book_name' => 'Fareler Ve İnsanlar',
            'author'=> 'John Steinbeck',
        ]);

        Book::create([
            'book_name' => 'Sinekli Bakkal',
            'author'=> 'Halide Edib Adıvar',
        ]);

        Book::create([
            'book_name' => 'Kürk Mantolu Madonna',
            'author'=> 'Sabahattin Ali',
        ]);
    }
}
