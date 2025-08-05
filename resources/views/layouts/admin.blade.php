@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            Bem-vindo, <strong>{{ Auth::user()->name }}</strong> 
            <span class="badge bg-secondary text-light ms-2">{{ Auth::user()->nivel_perfil }}</span>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">Sair</button>
        </form>
    </div>

    <div class="card-body">
        <div class="row g-4 justify-content-center">
        <div class="d-flex justify-content-start">
            <a href="{{ url('/') }}" class="btn btn-warning btn-sm">Voltar</a>
        </div>

            @yield('content-child')
        </div>
    </div>
</div>
@endsection
