@extends('layouts.app')

@section('content')
<div class="card-header text-center">
  Login
</div>
<div class="card-body">
  @if(session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
      <input name="email" type="email" class="form-control" placeholder="E-mail" required autofocus>
    </div>
    <div class="mb-3">
      <input name="password" type="password" class="form-control" placeholder="Senha" required>
    </div>
    <button class="btn btn-primary w-100" type="submit">Entrar</button>
  </form>
@endsection
