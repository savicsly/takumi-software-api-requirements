<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\CreateProductAction;
use App\Actions\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreProductRequest;
use App\Http\Requests\Api\V1\UpdateProductRequest;
use App\Http\Resources\V1\ProductResource;
use App\Models\DataTransferObjects\ProductData;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(
        private readonly CreateProductAction $createProductAction,
        private readonly UpdateProductAction $updateProductAction,
    ) {}

    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(Product::all());
    }

    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }

    public function store(StoreProductRequest $request): ProductResource
    {
        $productData = new ProductData(...$request->validated());

        $product = $this->createProductAction->execute($productData);

        return ProductResource::make($product);
    }

    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $productData = new ProductData(...$request->validated());

        $product = $this->updateProductAction->execute($productData, $product);

        return ProductResource::make($product);
    }

    public function destroy(Product $product): Response
    {
        $product->delete();

        return response()->noContent();
    }
}