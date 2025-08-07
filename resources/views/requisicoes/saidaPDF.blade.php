<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Auditoria da Requisição</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        .assinaturas { margin-top: 50px; }
        .linha-assinatura { margin-top: 60px; }
        .assinatura { display: inline-block; width: 45%; text-align: center; }
    </style>
</head>
<body>
    <h3>Auditoria da Requisição #{{ $requisicao->id_requisicao }} - Cliente: {{ $requisicao->cliente->name }}</h3>

    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Qtd Solicitada</th>
                <th>Estoque Atual</th>
                <th>Estoque Após Saída</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requisicao->itens as $item)
                @php
                    $produto = $item->produto;
                    $estoqueAtual = $produto->quantidade;
                    $qtdSolicitada = $item->quantidade;
                    $restante = null;
                    $status = '';

                    if ($produto->tipo_produto_id == 2) {
                        $composicao = \DB::table('produto_composicao')->where('produto_composto_id', $produto->id_produto)->get();
                        foreach ($composicao as $comp) {
                            $produtoSimples = \App\Models\Produtos::find($comp->produto_simples_id);
                            $totalNecessario = $item->quantidade * $comp->quantidade;
                            $restante = $produtoSimples->quantidade - $totalNecessario;

                            if ($restante < 0) {
                                $status .= "Insuficiente: {$produtoSimples->nome_produto}\n";
                            } elseif ($restante <= 3) {
                                $status .= "Vai zerar: {$produtoSimples->nome_produto}\n";
                            } else {
                                $status .= "OK\n";
                            }
                        }
                    } else {
                        $restante = $estoqueAtual - $qtdSolicitada;
                        $status = $restante < 0 ? 'Estoque Insuficiente' : ($restante <= 3 ? 'Vai zerar' : 'OK');
                    }
                @endphp
                <tr>
                    <td>{{ $produto->nome_produto }}</td>
                    <td>{{ $qtdSolicitada }}</td>
                    <td>{{ $estoqueAtual }}</td>
                    <td>{{ max($restante ?? 0, 0) }}</td>
                    <td>{{ $status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="assinaturas">
        <p><strong>Data e hora da saída:</strong> {{ $dataHoraSaida }}</p>

        <div class="linha-assinatura">
            <div class="assinatura">
                _______________________________________<br>
                <strong>Entregador</strong>
            </div>

            <div class="assinatura" style="float: right;">
                _______________________________________<br>
                <strong>Recebedor</strong>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("load", function () {
            console.log('carregou')
            window.print();
        });
    </script>
</body>
</html>