@extends('layouts.admin')

@section('content-child')
    <form id="form-requisicao" action="{{ route('usuarios.deletar', ['id' => $usuario->id ]) }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="row mb-4">
            <p>Deseja excluir <b>{{ $usuario->name }}</b>?</p>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <a href="{{ URL::previous() }}" class="btn btn-secondary mx-1">Cancelar</a>
            <button type="submit" class="btn btn-danger">Deletar</button>
        </div>
    </form>
@endsection