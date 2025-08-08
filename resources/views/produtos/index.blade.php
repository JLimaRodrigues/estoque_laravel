@extends('layouts.admin')

@section('content-child')

@include('resultado')

        <div class="d-flex justify-content-between">
            <a href="{{ route('produtos.confirmarEntrada') }}" class="btn btn-secondary btn-sm">Registrar Entrada</a>
            <a href="{{ route('produtos.novo') }}" class="btn btn-success btn-sm">Criar Produto</a>
        </div>
    <table class="table table-striped table-bordered" id="tabela-produtos">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Criado em</th>
                <th>Quantidade</th>
                <th>Custo</th>
                <th>Valor</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto->nome_produto }}</td>
                    <td>{{ \Carbon\Carbon::parse($produto->created_at)->format('d/m/Y') }}</td>
                    <td>{{ $produto->quantidade }}</td>
                    <td>{{ $produto->custo == '0.00' ? ' - ' : 'R$' . $produto->custo }}</td>
                    <td>R$ {{ $produto->valor }}</td>
                    <td>{{ $produto->tipoProduto->tipo }}</td>
                    <td>
                        <a href="{{ route('produtos.editar', ['id' => $produto->id_produto ]) }}" class="btn btn-sm btn-info">Editar</a>
                        <a href="{{ route('produtos.confirmarExclusao', ['id' => $produto->id_produto ]) }}" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection