<?php

namespace Database\Seeders;

use App\Models\Reason;
use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    public function run(): void
    {
        $reasons = [
            'INDUCCIÓN CORPORATIVA',
            'REINDUCCIÓN',
            'CAPACITACIÓN',
            'DIVULGACIÓN DE INFORMACIÓN',
            'COMITÉ PRIMARIO',
        ];

        foreach ($reasons as $name) {
            Reason::firstOrCreate(['name' => $name]);
        }

        $this->command->info('Reasons seeded successfully.');
    }
}
