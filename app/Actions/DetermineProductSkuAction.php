<?php

declare(strict_types=1);


namespace App\Actions;

use App\Models\Product;

class DetermineProductSkuAction
{
    public function execute(): int
    {
        $sku = Product::max('sku');

        if ($sku) {
            ++$sku;
        } else {
            $sku = 1;
        }

        return $sku;
    }
}