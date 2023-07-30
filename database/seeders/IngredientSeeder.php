<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\IngredientsCategory;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredientsData = [];

        $numberOfIngredients = 15; // You can change this to generate more or fewer ingredients

        $availableCategories = IngredientsCategory::pluck('id')->toArray();

        for ($i = 0; $i < $numberOfIngredients; $i++) {
            $ingredientData = [
                'name' => 'Ingredient ' . ($i + 1),
                'description' => 'Description for Ingredient ' . ($i + 1),
                'image' => 'ingredient' . ($i + 1) . '.jpg',
                'quantity' => rand(1, 100),
                'price' => rand(5, 50) / 10,
                'ingredient_category_id' => $this->getRandomCategory($availableCategories),
            ];

            $ingredientsData[] = $ingredientData;
        }

        Ingredient::insert($ingredientsData);
    }

    /**
     * Get a random category ID from the available categories.
     *
     * @param array $availableCategories
     * @return int|null
     */
    private function getRandomCategory(array $availableCategories): ?int
    {
        if (count($availableCategories) === 0) {
            return null;
        }

        return $availableCategories[array_rand($availableCategories)];
    }
}
