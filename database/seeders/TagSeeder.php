<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample article with a random story about sports
        $article = Article::create([
            'title' => 'Voorbeeldartikel over Sport',
            'description' => 'Dit is een voorbeeldartikel over sport. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum euismod, libero vel ultricies lacinia, eros neque condimentum risus, nec blandit augue risus ac ipsum. Sed et dui nec libero rhoncus pellentesque in non purus. Ut aliquam lacus eget neque dictum, a porttitor turpis pretium. Nullam vel lacus dolor. Morbi vehicula rhoncus leo, in volutpat ipsum condimentum nec. Cras sed erat quis nisi fringilla dapibus. Sed eget tortor ut sem fringilla aliquet nec et metus. Duis sodales sem a eros gravida volutpat. Curabitur semper dui sed diam pharetra, nec rutrum eros sollicitudin. Nam sed congue ligula.',
            'categorieId' => 1, // Assuming category with ID 1 exists
            'usersId' => 1, // Assuming user with ID 1 exists
        ]);

        // Create the tags with Dutch titles and descriptions
        $tags = [
            ['title' => 'Technologie', 'description' => 'Nieuws over technologie.'],
            ['title' => 'Gezondheid', 'description' => 'Artikelen over gezondheid en welzijn.'],
            ['title' => 'Entertainment', 'description' => 'Updates uit de wereld van entertainment.'],
            ['title' => 'Reizen', 'description' => 'Reisgidsen en bestemmingsrecensies.'],
            ['title' => 'Eten', 'description' => 'Recepten en voedingsgerelateerde inhoud.'],
        ];

        // Loop through the tags and create them, then attach them to the article
        foreach ($tags as $tagData) {
            $tag = Tag::create($tagData);
            $article->tags()->attach($tag->id);
        }
    }
}
