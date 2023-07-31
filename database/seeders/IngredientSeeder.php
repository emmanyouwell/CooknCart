<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            [
                'name' => 'Apple',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non ipsum vitae elit tincidunt bibendum.',
                'ingredient_category_id' => '2',
                'image' => 'https://www.collinsdictionary.com/images/full/apple_158989157.jpg',
                'price' => 100
            ],
            [
                'name' => 'Pineapple',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non ipsum vitae elit tincidunt bibendum.',
                'ingredient_category_id' => '2',
                'image' => 'https://safeselect.ph/cdn/shop/products/Pineapplerevised_1600x.jpg?v=1641873638',
                'price' => 120
            ],
            [
                'name' => 'Melon',
                'ingredient_category_id' => '2',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non ipsum vitae elit tincidunt bibendum.',
                'image' => 'https://static.libertyprim.com/files/familles/melon-large.jpg?1574629891',
                'price' => 90
            ],
            [
                'name' => 'Watermelon',
                'ingredient_category_id' => '2',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non ipsum vitae elit tincidunt bibendum.',
                'image' => 'https://www.gardeningknowhow.com/wp-content/uploads/2021/05/whole-and-slices-watermelon.jpg',
                'price' => 80
            ],
            [
                'name' => 'Banana',
                'ingredient_category_id' => '2',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non ipsum vitae elit tincidunt bibendum.',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8a/Banana-Single.jpg/800px-Banana-Single.jpg',
                'price' => 110
            ],
        ];

        foreach ($ingredients as $ingredient) {
            $ingredientData = [
                'ingredient_category_id'=> $ingredient['ingredient_category_id'],
                'name' => $ingredient['name'],
                'description' => $ingredient['description'],
                'image' => $ingredient['image'],
                'quantity' => rand(1, 100),
                'price' => $ingredient['price'],
            ];

            Ingredient::create($ingredientData);
        }
    }
}
