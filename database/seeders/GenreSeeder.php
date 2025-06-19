<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genreNames = ['きょうのこと', 'ふと思った', 'ことばあそび', 'ぼんやりと', '心の中', '存在感', 'きれい', 'うらやましい', '違和感', '思い出'];

        foreach ($genreNames as $name) {
            Genre::create(['name' => $name]);
        }
    }
}
