<?php

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

        DB::table('users')->insert([
            'name' => 'Ignacio FLores',
            'email'=> 'correo2@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://www.facebook.com/groups/programadoreschile.org/?multi_permalinks=989877734820744&notif_id=1598496620760547&notif_t=group_highlights&ref=notif',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
