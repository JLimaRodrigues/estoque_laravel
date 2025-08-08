@extends('layouts.admin')

@section('content-child')
<form action="{{ route('produtos.registrarEntrada') }}" method="POST" id="form-entrada">
    @csrf

    <div class="row mb-4">
        <div class="col-md-4">
            <label>Produto</label>
            <select id="produtoSelect" class="form-select">
                <option value="">Selecione um produto</option>
                @foreach ($produtos as $produto)
                    <option 
                        value="{{ $produto->id_produto }}" 
                        data-nome="{{ $produto->nome_produto }}" 
                        data-custo="{{ $produto->custo }}" 
                        data-valor="{{ $produto->valor }}" 
                        data-estoque="{{ $produto->quantidade }}">
                        {{ $produto->nome_produto }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label>Nome</label>
            <input type="text" id="produtoNome" class="form-control" readonly>
        </div>

        <div class="col-md-2">
            <label>Qtd Requisitada</label>
            <input type="number" id="produtoQtd" class="form-control" min="1" value="1">
        </div>

        <div class="col-md-2">
            <label>Preço Custo</label>
            <input type="text" id="produtoCusto" class="form-control" readonly>
        </div>

        <div class="col-md-2">
            <label>Preço Venda</label>
            <input type="text" id="produtoValor" class="form-control" readonly>
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
                <th>Preço Custo</th>
                <th>Preço Venda</th>
                <th>Total Custo</th>
                <th>Total Venda</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end"><strong>Total Geral:</strong></td>
                <td id="totalCusto" class="fw-bold">R$ 0,00</td>
                <td id="totalVenda" class="fw-bold">R$ 0,00</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <input type="hidden" name="itens" id="itensJson">

    <div class="mt-4 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">Registrar Entrada</button>
    </div>
</form>
@endsection

@push('scripts')
<script>
    let itens = [];

    const selectProduto = document.getElementById('produtoSelect');
    const inputNome = document.getElementById('produtoNome');
    const inputQtd = document.getElementById('produtoQtd');
    const inputCusto = document.getElementById('produtoCusto');
    const inputValor = document.getElementById('produtoValor');

    const tabelaBody = document.querySelector('#tabelaProdutos tbody');
    const hiddenInput = document.getElementById('itensJson');
    const totalCustoEl = document.getElementById('totalCusto');
    const totalVendaEl = document.getElementById('totalVenda');

    selectProduto.addEventListener('change', () => {
        const option = selectProduto.options[selectProduto.selectedIndex];
        inputNome.value = option.dataset.nome || '';
        inputCusto.value = option.dataset.custo ? parseFloat(option.dataset.custo).toFixed(2) : '';
        inputValor.value = option.dataset.valor ? parseFloat(option.dataset.valor).toFixed(2) : '';
        inputQtd.value = 1;
    });

    function adicionarItem() {
        const id = selectProduto.value;
        const nome = inputNome.value;
        const custo = parseFloat(inputCusto.value.replace(',', '.'));
        const valor = parseFloat(inputValor.value.replace(',', '.'));
        const qtd = parseInt(inputQtd.value);

        if (!id || !nome || isNaN(qtd) || qtd < 1 || isNaN(custo) || isNaN(valor)) {
            alert('Por favor, preencha todos os campos corretamente.');
            return;
        }

        // Se já existe produto no array, soma as quantidades
        const indexExistente = itens.findIndex(item => item.id == id);
        if (indexExistente >= 0) {
            itens[indexExistente].qtd += qtd;
        } else {
            itens.push({ id, nome, qtd, custo, valor });
        }
        renderizarTabela();
        limparCampos();
    }

    function removerItem(index) {
        itens.splice(index, 1);
        renderizarTabela();
    }

    function renderizarTabela() {
        tabelaBody.innerHTML = '';
        let totalCusto = 0;
        let totalVenda = 0;

        itens.forEach((item, index) => {
            const totalItemCusto = item.qtd * item.custo;
            const totalItemVenda = item.qtd * item.valor;

            tabelaBody.innerHTML += `
                <tr>
                    <td>${item.nome}</td>
                    <td>${item.qtd}</td>
                    <td>R$ ${item.custo.toFixed(2)}</td>
                    <td>R$ ${item.valor.toFixed(2)}</td>
                    <td>R$ ${totalItemCusto.toFixed(2)}</td>
                    <td>R$ ${totalItemVenda.toFixed(2)}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removerItem(${index})">Remover</button></td>
                </tr>
            `;

            totalCusto += totalItemCusto;
            totalVenda += totalItemVenda;
        });

        totalCustoEl.textContent = `R$ ${totalCusto.toFixed(2)}`;
        totalVendaEl.textContent = `R$ ${totalVenda.toFixed(2)}`;

        hiddenInput.value = JSON.stringify(itens);
    }

    function limparCampos() {
        selectProduto.value = '';
        inputNome.value = '';
        inputQtd.value = 1;
        inputCusto.value = '';
        inputValor.value = '';
    }
</script>
@endpush
