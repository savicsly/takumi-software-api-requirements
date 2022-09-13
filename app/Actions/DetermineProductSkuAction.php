<?php

declare(strict_types=1);


namespace App\Actions;

use App\Models\Product;
use Illuminate\Support\Str;

class DetermineProductSkuAction
{
    public function execute(): string
    {
        $sku = Product::max('sku');

        if ($sku) {
            ++$sku;
        } else {
            $sku = 1;
        }

        return Str::padLeft($sku, 6, '0');
    }
}