<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\{Produtos, TipoProduto, ProdutoComposicao, Entrada};
use Illuminate\Support\Facades\{Auth, DB};


class ProdutoController extends Controller
{
    public function index() 
    {
        $produtos = Produtos::with('tipoProduto')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function novoProduto() 
    {
        $tiposProduto    = TipoProduto::all();
        $produtosSimples = Produtos::all();

        return view('produtos.form', compact('tiposProduto', 'produtosSimples'));
    }

    public function criar(Request $request)
    {
        $data = $request->all();

        $data['valor'] = number_format((float) str_replace(',', '.', $data['valor']), 2, '.', '');
        $data['custo'] = number_format((float) str_replace(',', '.', $data['custo']), 2, '.', '');

        $validado = Validator::make($data, [
            'tipo_produto_id' => 'required|exists:tipo_produto,id_tipo_produto',
            'nome_produto'    => 'required|string|max:255',
            'custo'           => 'required|numeric|min:0',
            'valor'           => 'required|numeric|min:0',
        ])->validate();

        $produto = Produtos::create($validado);

        if ($produto->tipo_produto_id == 2 && $request->has('composicao')) {
            foreach ($request->composicao as $comp) {
                ProdutoComposicao::create([
                    'produto_composto_id' => $produto->id_produto,
                    'produto_simples_id'  => $comp['produto_simples_id'],
                    'quantidade'          => $comp['quantidade'],
                ]);
            }

            $produto->update(['custo' => $produto->calcularCustoComposto()]);
        }
        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function editarProduto($id)
    {
        $produto         = Produtos::with(['composicao'])->findOrFail($id);
        $tiposProduto    = TipoProduto::all();
        $produtosSimples = Produtos::all();

        return view('produtos.form', compact('produto', 'tiposProduto', 'produtosSimples'));
    }

    public function atualizarProduto(Request $request, $id)
    {
        $produto = Produtos::findOrFail($id);

        $data = $request->all();
        $data['valor'] = number_format((float) str_replace(',', '.', $data['valor']), 2, '.', '');
        $data['custo'] = number_format((float) str_replace(',', '.', $data['custo']), 2, '.', '');

        $validado = Validator::make($data, [
            'tipo_produto_id' => 'required|exists:tipo_produto,id_tipo_produto',
            'nome_produto'    => 'required|string|max:255',
            'custo'           => 'required|numeric|min:0',
            'valor'           => 'required|numeric|min:0',
        ])->validate();

        $produto->update($validado);

        if ($request->input('tipo_produto_id') == 2) {
            $produto->composicao()->delete();

            if ($request->has('composicao')) {
                $custoTotal = 0;
                foreach ($request->composicao as $comp) {
                    ProdutoComposicao::create([
                        'produto_composto_id' => $produto->id_produto,
                        'produto_simples_id'  => $comp['produto_simples_id'],
                        'quantidade'          => $comp['quantidade'],
                    ]);

                    $prodSimples = Produtos::find($comp['produto_simples_id']);
                    if ($prodSimples) {
                        $custoTotal += $prodSimples->custo * $comp['quantidade'];
                    }
                }

                $produto->update(['custo' => $custoTotal]);
            }
        } else {
            $produto->composicao()->delete();
        }

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function confirmarExclusao($id)
    {
        $produto = Produtos::findOrFail($id);

        return view('produtos.deletar', compact('produto'));
    }

    public function deletar($id)
    {
        Produtos::findOrFail($id)->delete();

        return redirect()->route('produtos.index')->with('success', 'Sucesso ao deletar registro!');
    }

    public function confirmarEntrada()
    {
        $produtos = Produtos::all();
        return view('produtos.confirmarEntrada', compact('produtos'));
    }

    //método de entrada usando calculo de média ponderada
    public function registrarEntrada(Request $request)
    {
        $data = $request->validate([
            'itens' => 'required|string',
        ]);

        $itens = json_decode($data['itens'], true);

        if (!$itens || !is_array($itens) || count($itens) === 0) {
            return back()->withErrors(['itens' => 'Nenhum item válido foi enviado.']);
        }

        DB::transaction(function() use ($itens) {
            foreach ($itens as $item) {
                if (!isset($item['id'], $item['qtd'], $item['custo'], $item['valor'])) {
                    throw new \Exception('Dados incompletos para um dos itens.');
                }

                $produto = Produtos::findOrFail($item['id']);

                Entrada::create([
                    'produto_id'     => $produto->id_produto,
                    'quantidade'     => $item['qtd'],
                    'custo_unitario' => $item['custo'],
                    'valor_unitario' => $item['valor'],
                ]);

                $quantidadeAntiga = $produto->quantidade;
                $custoAntigo = $produto->custo;

                $quantidadeNova = $item['qtd'];
                $custoEntrada = $item['custo'];

                $quantidadeTotal = $quantidadeAntiga + $quantidadeNova;

                if ($quantidadeTotal > 0) {
                    $custoMedio = (
                        ($quantidadeAntiga * $custoAntigo) +
                        ($quantidadeNova * $custoEntrada)
                    ) / $quantidadeTotal;
                } else {
                    $custoMedio = 0;
                }

                $produto->quantidade = $quantidadeTotal;
                $produto->custo = round($custoMedio, 2);
                $produto->valor = $item['valor'];
                $produto->save();
            }
        });

        return redirect()->route('produtos.index')->with('success', 'Entrada registrada com sucesso e custo médio atualizado!');
    }


}
