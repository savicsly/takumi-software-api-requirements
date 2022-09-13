<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\CreateCategoryAction;
use App\Actions\UpdateCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCategoryRequest;
use App\Http\Requests\Api\V1\UpdateCategoryRequest;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use App\Models\DataTransferObjects\CategoryData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CreateCategoryAction $createCategoryAction,
        private readonly UpdateCategoryAction $updateCategoryAction,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }

    public function show(Category $category): CategoryResource
    {
        return CategoryResource::make($category);
    }

    public function store(StoreCategoryRequest $request): CategoryResource
    {
        $categoryData = new CategoryData(...$request->validated());

        $category = $this->createCategoryAction->execute($categoryData);

        return CategoryResource::make($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category): CategoryResource
    {
        $categoryData = new CategoryData(...$request->validated());

        $category = $this->updateCategoryAction->execute($categoryData, $category);

        return CategoryResource::make($category);
    }

    public function destroy(Category $category): Response
    {
        $category->delete();

        return response()->noContent();
    }
}