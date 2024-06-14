<?php

namespace Database\Seeders;

use App\Models\Article;

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::insert(
        [
            'title'       => 'First News Article',
            'description' => 'Content of the first news article.',
            'usersid'     => 1,
            'categorieId'  => 1
        ]);

        // Article::create([
        //     'title' => 'Second News Article',
        //     'description' => 'Content of the first news article.',
        //     'usersid'     => 1

        // ]);
    }
}
