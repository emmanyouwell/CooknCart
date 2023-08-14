<?php

namespace App\Imports;

use App\Models\IngredientsCategory;
use Maatwebsite\Excel\Concerns\ToModel;

class ingredientCategoriesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new IngredientsCategory([
            'name'        => $row[0],
            'description' => $row[1],
        ]);
    }
}

// <?php

// namespace App\Imports;

// use App\Models\Category;
// use Maatwebsite\Excel\Concerns\ToModel;

// class CategoriesImport implements ToModel
// {
//     /**
//      * @param array $row
//      *
//      * @return \Illuminate\Database\Eloquent\Model|null
//      */
//     public function model(array $row)
//     {
//         return new Category([
//             'name'        => $row[0],
//             'description' => $row[1],
//         ]);
//     }
// }
