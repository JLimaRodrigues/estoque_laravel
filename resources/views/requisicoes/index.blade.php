@extends('layouts.admin')

@section('content-child')

@include('resultado')

    <table class="table table-striped table-bordered" id="tabela-requisicoes">
        @if(in_array(Auth::user()->nivel_perfil, ['funcionario', 'gerente', 'admin']))
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Entregador</th>
                    <th>Cliente</th>
                    <th>Retirado em</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
        @else 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
        @endif

        @if(in_array(Auth::user()->nivel_perfil, ['funcionario', 'gerente', 'admin']))
            <tbody>
                @foreach($requisicoes as $requisicao)
                    <tr>
                        <td>{{ $requisicao->id_requisicao }}</td>
                        <td>{{ \Carbon\Carbon::parse($requisicao->data)->format('d/m/Y') }}</td>
                        <td>{{ $requisicao->entregador->name ?? 'N/A' }}</td>
                        <td>{{ $requisicao->cliente->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($requisicao->updated_at)->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($requisicao->status) }}</td>
                        <td>
                            <a href="{{ route('requisicoes.auditarSaida', ['id' => $requisicao->id_requisicao]) }}" class="btn btn-sm btn-warning"><i class="fas fa-truck"></i> Dar saída</a>
                            @if ($requisicao->status == 'entregue')
                                <a href="{{ route('requisicoes.imprimirSaida', ['id' => $requisicao->id_requisicao]) }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-file-import"></i></i> Imprimir</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @else 
            <tbody>
                @foreach($requisicoes as $requisicao)
                    <tr>
                        <td>{{ $requisicao->id_requisicao }}</td>
                        <td>{{ \Carbon\Carbon::parse($requisicao->data)->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($requisicao->status) }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Ver</a>
                            <a href="#" class="btn btn-sm btn-primary">Copiar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @endif
    </table>
@endsection