@extends('layouts.admin')

@section('content-child')

@include('resultado')

        <div class="d-flex justify-content-end">
            <a href="{{ route('usuarios.novo') }}" class="btn btn-success btn-sm">Criar Usuario</a>
        </div>
    <table class="table table-striped table-bordered" id="tabela-produtos">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Criado em</th>
                <th>Email</th>
                <th>Nivel</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y') }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->nivel_perfil }}</td>
                    <td>
                        <a href="{{ route('usuarios.editar', ['id' => $usuario->id ]) }}" class="btn btn-sm btn-info">Editar</a>
                        <a href="{{ route('usuarios.confirmarExclusao', ['id' => $usuario->id ]) }}" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection