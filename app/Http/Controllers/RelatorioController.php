<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Requisicoes;
use App\Models\Produtos;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }

    // Gera o relatório conforme filtro enviado
    public function gerar(Request $request)
    {
        $request->validate([
            'data_inicial' => 'required|date',
            'data_final'   => 'required|date|after_or_equal:data_inicial',
            'tipo'        => 'required|in:entrada,saida',
        ]);

        $dataInicial = $request->input('data_inicial');
        $dataFinal   = $request->input('data_final');
        $tipo        = $request->input('tipo');

        if ($tipo === 'entrada') {
            // Relatório de entradas
            $query = Entrada::select(
                'produto_id',
                DB::raw('SUM(quantidade) as total_quantidade'),
                DB::raw('AVG(custo_unitario) as preco_custo_medio'),
                DB::raw('AVG(valor_unitario) as preco_venda_medio')
            )
            ->whereBetween(DB::raw('DATE(created_at)'), [$dataInicial, $dataFinal])
            ->groupBy('produto_id');

            $entradas = $query->get()->map(function ($item) {
                $produto = Produtos::find($item->produto_id);
                return (object)[
                    'nome' => $produto ? $produto->nome_produto : 'Produto não encontrado',
                    'quantidade' => $item->total_quantidade,
                    'preco_custo' => $item->preco_custo_medio,
                    'total_custo' => $item->total_quantidade * $item->preco_custo_medio,
                    'preco_venda' => $item->preco_venda_medio,
                    'total_venda' => $item->total_quantidade * $item->preco_venda_medio,
                ];
            });

            $totalGeralCusto = $entradas->sum('total_custo');
            $totalGeralVenda = $entradas->sum('total_venda');

            return view('relatorios.entrada', compact(
                'entradas', 'dataInicial', 'dataFinal', 'totalGeralCusto', 'totalGeralVenda'
            ));

        } else {
            // Relatório de saídas - baseado em requisições

            // Trazer os produtos simples e a quantidade total saída no período
            // Para produtos compostos, expandir para os componentes simples multiplicando quantidade requisitada

            // Busca as requisições entregues no período
            $requisicoes = Requisicoes::with('itens.produto')->where('status', 'entregue')
                ->whereBetween(DB::raw('DATE(updated_at)'), [$dataInicial, $dataFinal])
                ->get();

            $saidaProdutos = [];

            foreach ($requisicoes as $req) {
                foreach ($req->itens as $item) {
                    $produto = $item->produto;

                    if ($produto->tipo_produto_id == 2) {
                        // Produto composto: expandir pelos componentes simples
                        $composicoes = DB::table('produto_composicao')
                            ->where('produto_composto_id', $produto->id_produto)
                            ->get();

                        foreach ($composicoes as $composicao) {
                            $idProdSimples = $composicao->produto_simples_id;
                            $quantidadeBaixa = $composicao->quantidade * $item->quantidade;

                            if (!isset($saidaProdutos[$idProdSimples])) {
                                $saidaProdutos[$idProdSimples] = 0;
                            }
                            $saidaProdutos[$idProdSimples] += $quantidadeBaixa;
                        }
                    } else {
                        // Produto simples
                        if (!isset($saidaProdutos[$produto->id_produto])) {
                            $saidaProdutos[$produto->id_produto] = 0;
                        }
                        $saidaProdutos[$produto->id_produto] += $item->quantidade;
                    }
                }
            }

            // Montar os objetos para a view
            $produtosSaida = collect();

            foreach ($saidaProdutos as $produtoId => $quantidade) {
                $produto = Produtos::find($produtoId);
                if ($produto) {
                    $produtosSaida->push((object)[
                        'nome' => $produto->nome_produto,
                        'quantidade' => $quantidade,
                        'preco_custo' => $produto->custo,
                        'total_custo' => $quantidade * $produto->custo,
                    ]);
                }
            }

            $totalGeralCusto = $produtosSaida->sum('total_custo');

            return view('relatorios.saida', compact(
                'produtosSaida', 'dataInicial', 'dataFinal', 'totalGeralCusto'
            ));
        }
    }
}
