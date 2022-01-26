<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\UserType;
use App\Models\User;
use App\Models\Address;
use App\Models\Status;
use App\Models\Delivery;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        # Tipos de usuário
        $user_types = ['Cliente', 'Operador', 'Entregador'];

        foreach ($user_types as $user_type) {
            UserType::create(["name" => $user_type]);
        }

        # Usuários de teste
        User::factory(10)->create();

        User::create([
            'name' => 'Operador da Silva',
            'email' => 'operator@husky.com',
            'email_verified_at' => now(),
            'password' => Hash::make('operator'), // password
            'remember_token' => Str::random(10),
            'user_type_id' => 2,
        ]);

        # Endereços de teste

        Address::factory(4)->create();

        # Status

        $statuses = ["Novo", "Entregando", "Finalizado", "Cancelado"];

        foreach ($statuses as $status) {
            Status::create(['name' => $status]);
        }

        # Entregas de teste

        Delivery::factory(6)->create();
    }
}
