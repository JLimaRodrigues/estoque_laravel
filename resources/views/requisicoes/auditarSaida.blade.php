@extends('layouts.admin')

@section('content-child')
<h4>Auditoria da Requisição #{{ $requisicao->id_requisicao }} do {{ $requisicao->cliente->name }}</h4>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Qtd Solicitada</th>
            <th>Estoque Atual</th>
            <th>Estoque Após Saída</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($requisicao->itens as $item)
            @php
                $produto = $item->produto;
                $estoqueAtual = $produto->quantidade;
                $qtdSolicitada = $item->quantidade;

                if ($produto->tipo_produto_id == 2) {
                    $composicao = DB::table('produto_composicao')->where('produto_composto_id', $produto->id_produto)->get();
                    $status = '';
                    foreach ($composicao as $comp) {
                        $produtoSimples = \App\Models\Produtos::find($comp->produto_simples_id);
                        $totalNecessario = $item->quantidade * $comp->quantidade;
                        $restante = $produtoSimples->quantidade - $totalNecessario;

                        if ($restante < 0) {
                            $status .= "<i class='fa-solid fa-square-xmark text-danger'></i> Insuficiente: {$produtoSimples->nome_produto} <br>";
                        } elseif ($restante <= 3) {
                            $status .= "<i class='fa-solid fa-triangle-exclamation text-warning'></i> Vai zerar: {$produtoSimples->nome_produto} <br>";
                        }
                    }
                } else {
                    $restante = $estoqueAtual - $qtdSolicitada;
                    $status = $restante < 0
                        ? "<i class='fa-solid fa-square-xmark text-danger'></i> Estoque Insuficiente"
                        : ($restante <= 3 ? "<i class='fa-solid fa-triangle-exclamation text-warning'></i> Vai zerar" : "<i class='fa-solid fa-square-check text-success'></i> OK");
                }
            @endphp
            <tr>
                <td>{{ $produto->nome_produto }}</td>
                <td>{{ $qtdSolicitada }}</td>
                <td>{{ $estoqueAtual }}</td>
                <td>{{ isset($restante) ? max($restante, 0) : '-' }}</td>
                <td>{!! $status !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<form action="{{ route('requisicoes.confirmarSaida', ['id' => $requisicao->id_requisicao]) }}" method="POST" onsubmit="return confirm('Confirmar saída?');">
    @csrf
    @method('PUT')
    <div class="mt-4 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">Confirmar Saída</button>
    </div>
</form>
@endsection