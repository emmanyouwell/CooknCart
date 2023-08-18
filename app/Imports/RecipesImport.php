<?php

namespace App\Imports;

use App\Models\Recipe;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class RecipesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            // Set a default value for instruction in case of issue
            $instruction = $row[7] ?: '[{"step":"To be edited"}]';

            // Set a default value for tags in case of issue
            $tags = $row[9] ?: 'To be edited';

            $recipe = new Recipe([
                'user_id' => Auth::user()->id,
                'category_id' => $row[1],
                'name' => $row[2],
                'description' => $row[3],
                'preptime' => $row[4],
                'cooktime' => $row[5],
                'servings' => $row[6] ?? 0, // Set a default value if servings are missing
                'instruction' => $instruction,
                'image' => $row[8],
                'tags' => $tags,
            ]);

            $recipe->save();
        }
    }
}
