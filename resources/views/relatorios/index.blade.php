@extends('layouts.admin')

@section('content-child')
<h3>Filtrar Relatório de Estoque</h3>

<form action="{{ route('relatorios.gerar') }}" method="GET" class="row g-3">

    <div class="col-md-3">
        <label for="data_inicial" class="form-label">Data Inicial</label>
        <input type="date" class="form-control" id="data_inicial" name="data_inicial" value="{{ old('data_inicial') }}" required>
    </div>

    <div class="col-md-3">
        <label for="data_final" class="form-label">Data Final</label>
        <input type="date" class="form-control" id="data_final" name="data_final" value="{{ old('data_final') }}" required>
    </div>

    <div class="col-md-3">
        <label class="form-label d-block">Tipo de Relatório</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo" id="entrada" value="entrada" {{ old('tipo') === 'entrada' ? 'checked' : '' }} required>
            <label class="form-check-label" for="entrada">Entrada</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipo" id="saida" value="saida" {{ old('tipo') === 'saida' ? 'checked' : '' }} required>
            <label class="form-check-label" for="saida">Saída</label>
        </div>
    </div>

    <div class="col-md-3 align-self-end">
        <button type="submit" class="btn btn-primary">Gerar Relatório</button>
    </div>

</form>
@endsection
