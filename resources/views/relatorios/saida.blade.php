@extends('layouts.admin')

@section('content-child')
<h3>Relatório de Saída de Estoque</h3>
<p>Período: {{ date('d/m/Y', strtotime($dataInicial)) }} até {{ date('d/m/Y', strtotime($dataFinal)) }}</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Qtd Retirada do Estoque</th>
            <th>Preço Custo Total (R$)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($produtosSaida as $saida)
        <tr>
            <td>{{ $saida->nome }}</td>
            <td>{{ $saida->quantidade }}</td>
            <td>{{ number_format($saida->total_custo, 2, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Nenhum registro encontrado para o período selecionado.</td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" class="text-end"><strong>Total Geral:</strong></td>
            <td><strong>{{ number_format($totalGeralCusto, 2, ',', '.') }}</strong></td>
        </tr>
    </tfoot>
</table>
@endsection
