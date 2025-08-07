<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\{Produtos, TipoProduto, ProdutoComposicao};
use Illuminate\Support\Facades\Auth;


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

        return view('produtos.criar', compact('tiposProduto', 'produtosSimples'));
    }

    public function criar(Request $request)
    {
        $data = $request->all();

        $data['valor'] = number_format((float) str_replace(',', '.', $data['valor']), 2, '.', '');
        $data['custo'] = number_format((float) str_replace(',', '.', $data['custo']), 2, '.', '');

        $validado = Validator::make($data, [
            'tipo_produto_id' => 'required|exists:tipo_produto,id_tipo_produto',
            'nome_produto'    => 'required|string|max:255',
            'quantidade'      => 'required|integer|min:0',
            'custo'           => 'required|numeric|min:0',
            'valor'           => 'required|numeric|min:0',
        ])->validate();

        Produtos::create($validado);
        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function editarProduto($id)
    {
        $produto         = Produtos::with(['composicao'])->findOrFail($id);
        $tiposProduto    = TipoProduto::all();
        $produtosSimples = Produtos::all();

        return view('produtos.criar', compact('produto', 'tiposProduto', 'produtosSimples'));
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
            'quantidade'      => 'required|integer|min:0',
            'custo'           => 'required|numeric|min:0',
            'valor'           => 'required|numeric|min:0',
        ])->validate();

        $produto->update($validado);

        if ($request->input('tipo_produto_id') == 2) {
            $produto->composicao()->delete();
            $produto->update(['custo' => 0]);

            if ($request->has('composicao')) {
                foreach ($request->composicao as $comp) {
                    ProdutoComposicao::create([
                        'produto_composto_id' => $produto->id_produto,
                        'produto_simples_id'  => $comp['produto_simples_id'],
                        'quantidade'          => $comp['quantidade'],
                    ]);
                }
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
}
