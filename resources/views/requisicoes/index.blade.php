@extends('layouts.admin')

@section('content-child')
    <table class="table table-striped table-bordered" id="tabela-requisicoes">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requisicoes as $requisicao)
                <tr>
                    <td>{{ $requisicao->id_requisicao }}</td>
                    <td>{{ $requisicao->data }}</td>
                    <td>{{ ucfirst($requisicao->status) }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info">Ver</a>
                        <a href="#" class="btn btn-sm btn-primary">Copiar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection