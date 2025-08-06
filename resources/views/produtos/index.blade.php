@extends('layouts.admin')

@section('content-child')
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
                    <td>R$ {{ $produto->custo }}</td>
                    <td>R$ {{ $produto->valor }}</td>
                    <td>{{ $produto->tipoProduto->tipo }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info">Editar</a>
                        <a href="#" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection