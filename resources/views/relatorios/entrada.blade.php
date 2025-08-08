@extends('layouts.admin')

@section('content-child')
<h3>Relatório de Entrada de Estoque</h3>
<p>Período: {{ date('d/m/Y', strtotime($dataInicial)) }} até {{ date('d/m/Y', strtotime($dataFinal)) }}</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Qtd Requisitada</th>
            <th>Preço Custo Total (R$)</th>
            <th>Preço Venda Total (R$)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($entradas as $entrada)
        <tr>
            <td>{{ $entrada->nome }}</td>
            <td>{{ $entrada->quantidade }}</td>
            <td>{{ number_format($entrada->total_custo, 2, ',', '.') }}</td>
            <td>{{ number_format($entrada->total_venda, 2, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Nenhum registro encontrado para o período selecionado.</td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" class="text-end"><strong>Total Geral:</strong></td>
            <td><strong>{{ number_format($totalGeralCusto, 2, ',', '.') }}</strong></td>
            <td><strong>{{ number_format($totalGeralVenda, 2, ',', '.') }}</strong></td>
        </tr>
    </tfoot>
</table>
@endsection
