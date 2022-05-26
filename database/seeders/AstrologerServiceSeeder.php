<?php

namespace Database\Seeders;

use App\Models\Astrologer;
use App\Models\Service;
use Illuminate\Database\Seeder;

class AstrologerServiceSeeder extends Seeder
{
    private array $astrologersNames = [
        'Lucy',
        'Ben',
        'Barbara',
        'Kevin',
        'Suzy',
        'Emma',
    ];

    private array $servicesNames = [
        'Natal card',
        'Detailed horoscope',
        'Compatibility report',
        'Horoscope for the year',
    ];

    public function run(): void
    {
        foreach ($this->astrologersNames as $key => $astrologersName) {
            if ($key < count($this->servicesNames)) {
                Astrologer::factory()
                    ->has(Service::factory([
                        'name' => $this->servicesNames[$key]
                    ]))
                    ->create([
                        'name' => $astrologersName,
                    ]);
            } else {
                Astrologer::factory()
                    ->create([
                        'name' => $astrologersName,
                    ]);
            }
        }
    }
}
