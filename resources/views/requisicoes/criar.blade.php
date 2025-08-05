@extends('layouts.admin')

@section('content-child')
    <form id="form-requisicao" action="{{ route('requisicoes.store') }}" method="POST">
        @csrf

        <div class="row mb-4">
            <div class="col-md-4">
                <label>Produto</label>
                <select id="produtoSelect" class="form-select">
                    <option value="">Selecione um produto</option>
                    @foreach ($produtos as $produto)
                        <option 
                            value="{{ $produto->id }}" 
                            data-nome="{{ $produto->nome }}" 
                            data-valor="{{ $produto->valor_unitario }}" 
                            data-estoque="{{ $produto->quantidade }}">
                            {{ $produto->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label>Nome</label>
                <input type="text" id="produtoNome" class="form-control" readonly>
            </div>

            <div class="col-md-2">
                <label>Qtd</label>
                <input type="number" id="produtoQtd" class="form-control" min="1">
            </div>

            <div class="col-md-2">
                <label>Valor</label>
                <input type="text" id="produtoValor" class="form-control" readonly>
            </div>

            <div class="col-md-2">
                <label>Total</label>
                <input type="text" id="produtoTotal" class="form-control" readonly>
            </div>
        </div>

        <div class="mb-3">
            <button type="button" class="btn btn-primary" onclick="adicionarItem()">Adicionar</button>
        </div>

        <table class="table table-bordered" id="tabelaProdutos">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Qtd</th>
                    <th>Valor Unitário</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total Geral:</strong></td>
                    <td colspan="2" id="totalGeral" class="fw-bold">R$ 0,00</td>
                </tr>
            </tfoot>
        </table>

        <input type="hidden" name="itens" id="itensJson">

        <div class="mt-4 d-flex justify-content-end">
            <a href="{{ route('requisicoes.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-success">Fazer Requisição</button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    let itens = [];

    const selectProduto = document.getElementById('produtoSelect');
    const inputNome = document.getElementById('produtoNome');
    const inputQtd = document.getElementById('produtoQtd');
    const inputValor = document.getElementById('produtoValor');
    const inputTotal = document.getElementById('produtoTotal');
    const tabelaBody = document.querySelector('#tabelaProdutos tbody');
    const hiddenInput = document.getElementById('itensJson');

    selectProduto.addEventListener('change', () => {
        const option = selectProduto.options[selectProduto.selectedIndex];
        inputNome.value = option.dataset.nome || '';
        inputValor.value = option.dataset.valor || '';
        inputQtd.value = 1;
        calcularTotal();
    });

    inputQtd.addEventListener('input', calcularTotal);

    function calcularTotal() {
        const valor = parseFloat(inputValor.value);
        const qtd = parseInt(inputQtd.value);
        if (!isNaN(valor) && !isNaN(qtd)) {
            inputTotal.value = (valor * qtd).toFixed(2);
        } else {
            inputTotal.value = '';
        }
    }

    function adicionarItem() {
        const id = selectProduto.value;
        const nome = inputNome.value;
        const valor = parseFloat(inputValor.value);
        const qtd = parseInt(inputQtd.value);
        const total = parseFloat(inputTotal.value);

        if (!id || isNaN(qtd) || qtd < 1 || isNaN(valor)) {
            alert('Preencha corretamente os campos.');
            return;
        }

        const estoque = parseInt(selectProduto.options[selectProduto.selectedIndex].dataset.estoque);
        if (qtd > estoque) {
            alert('Quantidade excede o estoque disponível.');
            return;
        }

        const item = { id, nome, qtd, valor, total };
        itens.push(item);
        renderizarTabela();
        limparCampos();
    }

    function removerItem(index) {
        itens.splice(index, 1);
        renderizarTabela();
    }

    function renderizarTabela() {
        tabelaBody.innerHTML = '';
        let totalGeral = 0;
        
        itens.forEach((item, index) => {
            tabelaBody.innerHTML += `
                <tr>
                    <td>${item.nome}</td>
                    <td>${item.qtd}</td>
                    <td>R$ ${item.valor.toFixed(2)}</td>
                    <td>R$ ${item.total.toFixed(2)}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removerItem(${index})">Remover</button>
                    </td>
                </tr>
            `;
            totalGeral += item.total;
        });

        document.getElementById('totalGeral').innerText = `R$ ${totalGeral.toFixed(2)}`;
        hiddenInput.value = JSON.stringify(itens);
    }

    function limparCampos() {
        selectProduto.value = '';
        inputNome.value = '';
        inputQtd.value = '';
        inputValor.value = '';
        inputTotal.value = '';
    }
</script>
@endpush