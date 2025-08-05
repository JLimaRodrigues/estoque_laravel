<?php

use Illuminate\Database\Seeder;

class TipoProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_produto = [
            [
                'tipo' => 'Simples'
            ],
            [
                'tipo' => 'Composto'
            ]
        ];

        DB::table('tipo_produto')->insert($tipo_produto);
    }
}
