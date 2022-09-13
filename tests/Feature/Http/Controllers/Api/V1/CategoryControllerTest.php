<?php

declare(strict_types=1);

use App\Models\Category;

use function Pest\Laravel\getJson;

it('can list categories', function () {
    $this->withoutExceptionHandling();

    $category = Category::factory()->create();

    $response = getJson(route('api.v1.categories.index'))
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'slug',
                ],
            ],
        ]);

    expect($response->json('data'))->toHaveCount(1)
        ->and($response->json('data.0.id'))->toBe($category->id)
        ->and($response->json('data.0.name'))->toBe($category->name);
});

it('can show category', function () {
    $this->withoutExceptionHandling();

    $category = Category::factory()->create();

    $response = getJson(route('api.v1.categories.show', $category))
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'slug',
            ],
        ]);

    expect($response->json('data.id'))->toBe($category->id)
        ->and($response->json('data.name'))->toBe($category->name);
});

