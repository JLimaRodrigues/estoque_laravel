<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Produtos;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lata = Produtos::create([
            'nome_produto' => 'REFRIGERANTE LATA 350ml',
            'quantidade' => 100,
            'custo' => 0.85,
            'valor' => 1.20,
            'tipo_produto_id' => 1
        ]);

        $cafe = Produtos::create([
            'nome_produto' => 'CAFÉ PCT. 500gr',
            'quantidade' => 15,
            'custo' => 3.00,
            'valor' => 4.50,
            'tipo_produto_id' => 1
        ]);

        $arroz = Produtos::create([
            'nome_produto' => 'ARROZ BRANCO TIPO 1 PCT. 5kg',
            'quantidade' => 10,
            'custo' => 3.90,
            'valor' => 5.00,
            'tipo_produto_id' => 1
        ]);

        $feijao = Produtos::create([
            'nome_produto' => 'FEIJÃO PRETO TIPO 1 PCT. 1kg',
            'quantidade' => 10,
            'custo' => 1.85,
            'valor' => 2.99,
            'tipo_produto_id' => 1
        ]);

        $fardo = Produtos::create([
            'nome_produto' => 'REFRIGERANTE LATA 350ml - FARDO 12 UND',
            'quantidade' => 10,
            'custo' => 0,
            'valor' => 14.40,
            'tipo_produto_id' => 2
        ]);

        DB::table('produto_composicao')->insert([
            'produto_composto_id' => $fardo->id_produto,
            'produto_simples_id' => $lata->id_produto,
            'quantidade' => 12
        ]);

        $cesta = Produtos::create([
            'nome_produto' => 'CESTA BÁSICA PADRÃO',
            'quantidade' => 5,
            'custo' => 0,
            'valor' => 12.49,
            'tipo_produto_id' => 2
        ]);

        DB::table('produto_composicao')->insert([
            [
                'produto_composto_id' => $cesta->id_produto,
                'produto_simples_id' => $arroz->id_produto,
                'quantidade' => 1
            ],
            [
                'produto_composto_id' => $cesta->id_produto,
                'produto_simples_id' => $feijao->id_produto,
                'quantidade' => 1
            ],
            [
                'produto_composto_id' => $cesta->id_produto,
                'produto_simples_id' => $cafe->id_produto,
                'quantidade' => 1
            ]
        ]);
    }
}
