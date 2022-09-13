<?php

declare(strict_types=1);


namespace App\Models\DataTransferObjects;

class ProductData
{
    public function __construct(
        public readonly string $name,
        public readonly int $price,
        public readonly int $category_id,
    ) {}
}