<?php

namespace Tests\Feature;

use App\Models\Astrologer;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AstrologersShowTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public const URI = 'api/astrologers';

    protected bool $seed = true;

    private Astrologer $astrologer;

    public function setUp(): void
    {
        parent::setUp();

        $this->astrologer = Astrologer::factory()
            ->has(Service::factory([
                'name' => $this->faker->name
            ]))
            ->create([
                'name' => $this->faker->name,
            ]);
        ;
    }

    public function testOk(): void
    {
        $this->sendRequest('GET', self::URI, $this->astrologer->uuid)
            ->assertOk()
            ->assertJsonStructure([
                'name',
                'photo',
                'email',
                'biography',
                'services',
            ]);

    }

    public function testWrongMethodType(): void
    {
        $this->sendRequest('PUT', self::URI, $this->astrologer->uuid)
            ->assertStatus(405)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testWrongUuid(): void
    {
        $this->sendRequest('GET', self::URI, $this->faker->uuid)
            ->assertNotFound()
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testWrongUri(): void
    {
        $this->sendRequest('GET', sha1(self::URI), $this->astrologer->uuid)
            ->assertNotFound()
            ->assertJsonStructure([
                'message',
            ]);
    }

    private function sendRequest(string $methodType, string $uri, string $uuid): TestResponse
    {
        return $this->withHeaders([
            'Accept' => 'application/json',
        ])->json(
            $methodType,
            $uri.DIRECTORY_SEPARATOR.$uuid
        );
    }
}
