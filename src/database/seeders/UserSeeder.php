<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $name = $this->command->ask('Nombre del usuario');
        $email = $this->command->ask('Correo electrónico');

        if (User::where('email', $email)->exists()) {
            $this->command->error("Ya existe un usuario con el correo {$email}.");
            return;
        }

        $password = $this->command->secret('Contraseña (mínimo 8 caracteres)');

        if (strlen($password) < 8) {
            $this->command->error('La contraseña debe tener al menos 8 caracteres.');
            return;
        }

        $isAdmin = $this->command->confirm('¿Es administrador?', false);

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'is_admin' => $isAdmin,
        ]);

        $this->command->info("Usuario {$name} ({$email}) creado correctamente.");
    }
}
