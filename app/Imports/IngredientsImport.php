<?php

// namespace App\Imports;

// use App\Models\Ingredient;
// use Maatwebsite\Excel\Concerns\ToModel;

// class IngredientsImport implements ToModel
// {
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */
//     public function model(array $row)
//     {
//         return new Ingredient([
//            'ingredient_category_id'=> $row[0],
//            'name'    => $row[1], 
//            'description' => $row[2],
//            'image'    => $row[3], 
//            'quantity'    => $row[4], 
//            'price'    => $row[5], 
           
//         ]);
//     }
// }


// <?php
namespace App\Imports;

use App\Models\Ingredient;
use App\Models\IngredientsCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class IngredientsImport implements ToModel, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Find or create the ingredient category
        $category = IngredientsCategory::firstOrCreate(
            ['name' => $row[0]],
            ['name' => $row[0]] // You can add additional fields here if needed
        );

        return new Ingredient([
            'ingredient_category_id' => $category->id,
            'name' => $row[1],
            'description' => $row[2],
            'image' => $row[3], // Assuming the image column contains filenames
            'quantity' => $row[4],
            'price' => $row[5],
        ]);
    }

    /**
     * Define validation rules for the import.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            // Define your validation rules here if needed
        ];
    }
}
