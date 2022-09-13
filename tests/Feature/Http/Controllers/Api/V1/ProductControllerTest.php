<?php

declare(strict_types=1);

use App\Models\Product;

use function Pest\Laravel\{deleteJson, getJson, postJson, putJson};

it('can list products', function () {
    $product = Product::factory()->create();

    $response  = getJson(route('api.v1.products.index'))
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'sku',
                    'name',
                    'price',
                    'category'
                ],
            ],
        ]);

    expect($response->json('data'))->toHaveCount(1)
        ->and($response->json('data.0.sku'))->toBe($product->sku)
        ->and($response->json('data.0.name'))->toBe($product->name)
        ->and($response->json('data.0.price'))->toBe($product->price);
});

it('can show a product', function () {
    $this->withoutExceptionHandling();

    $product = Product::factory()->create();

    $response = getJson(route('api.v1.products.show', $product))
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'sku',
                'name',
                'price',
                'category'
            ],
        ]);

    expect($response->json('data.sku'))->toBe($product->sku)
        ->and($response->json('data.name'))->toBe($product->name)
        ->and($response->json('data.price'))->toBe($product->price);
});

it('can create a product', function () {
    $this->withoutExceptionHandling();

    $product = Product::factory()->make([
        'sku' => '000001',
    ]);

    $response = postJson(route('api.v1.products.store'), [
        'name' => $product->name,
        'price' => $product->price,
        'category_id' => $product->category_id,
    ])->assertCreated();

    expect($response->json('data.sku'))->toBe($product->sku)
        ->and($response->json('data.name'))->toBe($product->name)
        ->and($response->json('data.price'))->toBe($product->price);
});

it('can update a product', function () {
    $this->withoutExceptionHandling();

    $product = Product::factory()->create([
        'sku' => '000001',
    ]);

    $response = putJson(route('api.v1.products.update', $product), [
        'name' => 'New name',
        'price' => 100,
        'category_id' => $product->category_id,
    ])->assertOk();

    expect($response->json('data.sku'))->toBe($product->sku)
        ->and($response->json('data.name'))->toBe('New name')
        ->and($response->json('data.price'))->toBe(100);
});

it('can delete a product', function () {
    $this->withoutExceptionHandling();

    $product = Product::factory()->create();

    deleteJson(route('api.v1.products.destroy', $product))
        ->assertNoContent();

    expect(Product::count())->toBe(0);
});

