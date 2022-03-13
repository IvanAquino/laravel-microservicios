<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\withHeaders;

beforeEach(function () {
    Artisan::call('db:seed', ['--force' => true]);
});

test('Recipes api respond with 6 recipes', function () {
    $response = withHeaders([
        'X-Internal-Communication-Token' => env('INTERNAL_COMMUNICATION_TOKEN'),
    ])->getJson('/api/recipes');


    $response->assertOk();
    $response->assertJson(function (AssertableJson $json) {
        $json->has('data', 6);
    });
});
