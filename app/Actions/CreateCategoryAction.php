<?php

declare(strict_types=1);


namespace App\Actions;

use App\Models\Category;
use App\Models\DataTransferObjects\CategoryData;
use Illuminate\Support\Str;

class CreateCategoryAction
{
    public function execute(CategoryData $categoryData): Category
    {
        return Category::query()
            ->create([
                'name' => $categoryData->name,
                'slug' => Str::slug($categoryData->name),
            ]);
    }
}