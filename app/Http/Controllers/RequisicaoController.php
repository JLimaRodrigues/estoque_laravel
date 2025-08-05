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

    public function store(Request $request) {
        $request->validate([
            'data' => 'required|date',
        ]);

        Requisicao::create([
            'usuario_id' => Auth::id(),
            'data' => $request->data,
            'status' => 'pendente',
        ]);

        return redirect()->route('requisicoes.index')->with('status', 'Requisição criada com sucesso!');
    }

    public function saida() {
        $requisicoes = Requisicao::where('status', 'pendente')->get();
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
