<?php

declare(strict_types=1);


namespace App\Actions;

use App\Models\Category;
use App\Models\DataTransferObjects\CategoryData;
use Illuminate\Support\Str;

class UpdateCategoryAction
{
    public function execute(CategoryData $categoryData, Category $category): Category
    {
        $category->update([
            'name' => $categoryData->name,
            'slug' => Str::slug($categoryData->name),
        ]);

        return $category;
    }
}