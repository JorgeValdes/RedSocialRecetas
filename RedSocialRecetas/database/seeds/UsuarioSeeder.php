<?php

use App\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Jorge',
            'email' => 'jorge.valdes.01@alu.ucm.cl',
            'password' => Hash::make('123456'),
            'url' => 'https://radio.x-team.com/?utm_source=facebook',
        ]);


        $user->perfil()->create();


        $user2 = User::create([
            'name' => 'Ignacio',
            'email' => 'cookexx47@gmail.com',
            'password' => Hash::make('123456'),
            'url' => 'https://radio.x-team.com/?utm_source=facebook',
        ]);

        $user2->perfil()->create();
    }
}
