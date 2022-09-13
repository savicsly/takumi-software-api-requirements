<?php

declare(strict_types=1);


namespace App\Actions;

use App\Models\DataTransferObjects\ProductData;
use App\Models\Product;

class UpdateProductAction
{
    public function execute(ProductData $productData, Product $product): Product
    {
        $product->update([
            'name' => $productData->name,
            'price' => $productData->price,
            'category_id' => $productData->category_id,
        ]);

        return $product;
    }
}