<?php

declare(strict_types=1);

use App\Actions\DetermineProductSkuAction;
use App\Models\Product;

it('can return product sku', function () {
    $product1 = Product::factory()->create(['sku' => '000001']);
    $product2 = Product::factory()->create(['sku' => '000002']);

    $sku = (new DetermineProductSkuAction())->execute();

    expect($sku)->toBe('000003')
        ->and($sku)->not->toBe($product1->sku)
        ->and($sku)->not->toBe($product2->sku);
});

it('it can return the right sku when the last one is deleted', function () {
    $product1 = Product::factory()->create(['sku' => '000001']);
    $product2 = Product::factory()->create(['sku' => '000002']);
    $product2->delete();

    $sku = (new DetermineProductSkuAction())->execute();

    expect($sku)->toBe('000002')
        ->and($sku)->not->toBe($product1->sku);
});

it('it can return the right sku when the last one is deleted and the next one is created', function () {
    $product1 = Product::factory()->create(['sku' => '000001']);
    $product2 = Product::factory()->create(['sku' => '000002']);
    $product2->delete();
    $product3 = Product::factory()->create(['sku' => '000003']);

    $sku = (new DetermineProductSkuAction())->execute();

    expect($sku)->toBe('000004')
        ->and($sku)->not->toBe($product1->sku)
        ->and($sku)->not->toBe($product3->sku);
});

