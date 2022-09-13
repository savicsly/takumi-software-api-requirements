<?php

declare(strict_types=1);


namespace App\Models\DataTransferObjects;

class CategoryData
{
    public function __construct(
        public readonly string $name,
    ) {}
}