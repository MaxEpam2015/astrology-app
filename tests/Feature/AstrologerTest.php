<?php

namespace Tests\Feature;

use App\Models\Astrologer;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AstrologerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

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

    public function testShowOk(): void
    {
        $this->getJson(
            route('astrologers.show', $this->astrologer->uuid),
            ['Accept' => 'application/json',]
        )->assertOk()
            ->assertJsonStructure([
                'name',
                'photo',
                'email',
                'biography',
                'services',
            ]);
    }

    public function testShowWrongMethodType(): void
    {
        $this->putJson(
            route('astrologers.show', $this->astrologer->uuid),
            ['Accept' => 'application/json',]
        )
            ->assertStatus(405)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testShowWrongUuid(): void
    {
        $this->getJson(
            route('astrologers.show', $this->faker->uuid),
            ['Accept' => 'application/json',]
        )->assertNotFound()
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testShowWrongUri(): void
    {
        $this->getJson(
            sha1(route('astrologers.show', $this->astrologer->uuid)),
            ['Accept' => 'application/json',]
        )
            ->assertNotFound()
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testIndexOk(): void
    {
        $this->getJson(
            route('astrologers.index'),
            ['Accept' => 'application/json',]
        )->assertOk()
            ->assertJsonStructure([
                'data'
            ]);
    }

    public function testIndexWrongMethodType(): void
    {
        $this->putJson(
            route('astrologers.index'),
            ['Accept' => 'application/json',]
        )
            ->assertStatus(405)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testIndexWrongUri(): void
    {
        $this->getJson(
            sha1(route('astrologers.index', $this->astrologer->uuid)),
            ['Accept' => 'application/json']
        )
            ->assertNotFound()
            ->assertJsonStructure([
                'message',
            ]);
    }
}
