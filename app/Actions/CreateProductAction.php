<?php

declare(strict_types=1);


namespace App\Actions;

use App\Models\DataTransferObjects\ProductData;
use App\Models\Product;
use Illuminate\Support\Str;

class CreateProductAction
{
    public function __construct(
        private readonly DetermineProductSkuAction $determineProductSkuAction,
    ) {}

    public function execute(ProductData $productData): Product
    {
        return Product::query()
            ->create([
                'sku' => Str::padLeft($this->determineProductSkuAction->execute($productData), 6, '0'),
                'name' => $productData->name,
                'price' => $productData->price,
                'category_id' => $productData->category_id,
            ]);
    }
}