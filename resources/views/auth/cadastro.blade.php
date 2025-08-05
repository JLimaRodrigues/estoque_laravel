@extends('layouts.app')

@section('content')
<div class="card-header text-center">
  Cadastro
</div>
<div class="card-body">
@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('registrar') }}">
@csrf
<div class="mb-3">
  <input name="name" type="text" class="form-control" placeholder="Nome" value="{{ old('name') }}" required>
</div>
<div class="mb-3">
  <input name="email" type="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" required>
</div>
<div class="mb-3">
  <input name="password" type="password" class="form-control" placeholder="Senha" required>
</div>
<div class="mb-3">
  <input name="password_confirmation" type="password" class="form-control" placeholder="Confirme a Senha" required>
</div>
<button class="btn btn-success w-100" type="submit">Cadastrar</button>
</form>
@endsection
