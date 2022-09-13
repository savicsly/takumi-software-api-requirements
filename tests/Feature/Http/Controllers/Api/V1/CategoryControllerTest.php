<?php

declare(strict_types=1);

use App\Models\Category;

use function Pest\Laravel\{getJson, postJson};

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

it('can create category', function () {
    $this->withoutExceptionHandling();

    $category = Category::factory()->make();

    $response = postJson(route('api.v1.categories.store'), [
        'name' => $category->name,
    ])->assertCreated()
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'slug',
            ],
        ]);

    expect($response->json('data.name'))->toBe($category->name);
    expect(Category::count())->toBe(1);
    expect(Category::query()->where('name', $category->name)->exists())->toBeTrue();
});

