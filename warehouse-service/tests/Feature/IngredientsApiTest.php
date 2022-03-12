<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\withHeaders;

beforeEach(function () {
    Artisan::call('db:seed', ['--force' => true]);
});

test('Ingredients api respond with 10 elements', function () {
    $response = withHeaders([
        'X-Internal-Communication-Token' => env('INTERNAL_COMMUNICATION_TOKEN'),
    ])->getJson('/api/ingredients');


    $response->assertOk();
    $response->assertJson(function (AssertableJson $json) {
        $json->has('data', 10);
    });
});
