<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Cliente',
                'email' => 'cliente@teste.com',
                'password' => Hash::make('12345678'),
                'nivel_perfil' => 'cliente',
            ],
            [
                'name' => 'Funcionario Comum',
                'email' => 'funcionario-comum@teste.com',
                'password' => Hash::make('12345678'),
                'nivel_perfil' => 'funcionario',
            ],
            [
                'name' => 'Gerente',
                'email' => 'gerente@teste.com',
                'password' => Hash::make('12345678'),
                'nivel_perfil' => 'gerente',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@teste.com',
                'password' => Hash::make('12345678'),
                'nivel_perfil' => 'admin',
            ],
        ];

        DB::table('users')->insert($users);
    }
}
