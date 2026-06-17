<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            ['name' => 'Director', 'is_active' => true],
            ['name' => 'Subdirector', 'is_active' => true],
            ['name' => 'Coordinador', 'is_active' => true],
            ['name' => 'Analista', 'is_active' => true],
            ['name' => 'Asistente', 'is_active' => true],
            ['name' => 'Secretario', 'is_active' => true],
            ['name' => 'Técnico', 'is_active' => true],
            ['name' => 'Profesional', 'is_active' => true],
        ];

        foreach ($positions as $position) {
            Position::firstOrCreate(
                ['name' => $position['name']],
                $position
            );
        }

        $this->command->info('Positions seeded successfully.');
    }
}
