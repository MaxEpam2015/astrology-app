<?php


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AstrologersIndexTest extends TestCase
{
    const URI = 'api/astrologers';

    use RefreshDatabase;

    protected bool $seed = true;

    public function testOk(): void
    {
        $this->sendRequest('GET', self::URI)
            ->assertOk()
            ->assertJsonStructure([
                'data'
            ]);

    }

    public function testWrongMethodType(): void
    {
        $this->sendRequest('PUT', self::URI)
            ->assertStatus(405)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testWrongUri(): void
    {
        $this->sendRequest('GET', sha1(self::URI))
            ->assertNotFound()
            ->assertJsonStructure([
                'message',
            ]);
    }

    private function sendRequest(string $methodType, string $uri): TestResponse
    {
        return $this->withHeaders([
            'Accept' => 'application/json',
        ])->json(
            $methodType,
            $uri
        );
    }
}
