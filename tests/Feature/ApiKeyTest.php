<?php

namespace Artapamudaid\SecureApiServer\Tests\Feature;

use Orchestra\Testbench\TestCase;
use Artapamudaid\SecureApiServer\SecureApiServiceProvider;
use Illuminate\Support\Facades\DB;

class ApiKeyTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [SecureApiServiceProvider::class];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations');
        $this->artisan('migrate')->run();
    }

    public function test_it_can_generate_api_key()
    {
        $response = $this->post('/secure-api/key');

        $response->assertStatus(200)
            ->assertJsonStructure(['key', 'secret']);
    }
}
