<?php

namespace App\Exports;

use App\Models\IngredientsCategory;
use Maatwebsite\Excel\Concerns\FromCollection;

class ingredientsCategoriesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return IngredientsCategory::all();
    }
}
