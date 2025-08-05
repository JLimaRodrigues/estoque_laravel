<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Requisicoes, Produtos};
use Illuminate\Support\Facades\Auth;


class RequisicaoController extends Controller
{
    public function index() {
        $usuario = Auth::user();
        $requisicoes = $usuario->nivel_perfil === 'cliente'
            ? Requisicoes::where('usuario_id', $usuario->id)->get()
            : Requisicoes::all();

        return view('requisicoes.index', compact('requisicoes'));
    }

    public function criar() {
        $produtos = Produtos::all();
        return view('requisicoes.criar', compact('produtos'));
    }

    public function registrarRequisicao(Request $request) {
        $request->validate([
            'itens' => 'required|json',
        ]);

        $itens = json_decode($request->itens, true);

        if (empty($itens)) {
            return redirect()->back()->withErrors(['itens' => 'Adicione pelo menos um item à requisição.']);
        }

        $requisicao = Requisicoes::create([
            'usuario_id' => Auth::id(),
            'data'       => now(),
            'status'     => 'pendente',
        ]);

        foreach ($itens as $item){
            $requisicao->itens()->create([
                'produto_id'     => $item['id'],
                'quantidade'     => $item['qtd'],
                'valor_unitario' => $item['valor']
            ]);
        }

        return redirect()->route('requisicoes.index')->with('status', 'Requisição criada com sucesso!');
    }

    public function saida()
    {
        $requisicoes = Requisicoes::with('itens.produto')->where('status', 'pendente')->get();
        return view('requisicoes.saida', compact('requisicoes'));
    }

    public function confirmarSaida($id) {
        $requisicao = Requisicao::findOrFail($id);
        $requisicao->update([
            'status' => 'entregue',
            'entregador_id' => Auth::id()
        ]);

        return redirect()->route('requisicoes.saida')->with('status', 'Requisição entregue!');
    }

}
