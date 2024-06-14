<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Voer de database-seeds uit.
     */
    public function run(): void
    {   
        // Voeg de categorie Sport toe
        Categorie::create([
            'title'       => 'Sport',
            'description' => 'Alle nieuws gerelateerd aan sport.',
        ]);

        // Voeg de categorie Politiek toe
        Categorie::create([
            'title'       => 'Politiek',
            'description' => 'Nieuws gerelateerd aan politiek en overheid.',
        ]);

        // Voeg de categorie Technologie toe
        Categorie::create([
            'title'       => 'Technologie',
            'description' => 'Laatste updates in de wereld van technologie.',
        ]);

        // Voeg de categorie Amusement toe
        Categorie::create([
            'title'       => 'entertainment',
            'description' => 'Nieuws en updates over films, muziek en meer.',
        ]);

        // Voeg de categorie Zakelijk toe
        Categorie::create([
            'title'       => 'Zakelijk',
            'description' => 'Nieuws gerelateerd aan de zakenwereld en economie.',
        ]);
    }
}
