@extends('layouts.admin')

@section('content-child')
<form id="form-produto" action="{{ isset($produto) ? route('produtos.atualizar', $produto->id_produto) : route('produtos.criar') }}" method="POST">
    @csrf
    @if(isset($produto))
        @method('PUT')
    @endif

    <div class="row mb-4">
        <div class="col-md-3">
            <label>Tipo de Produto</label>
            <select name="tipo_produto_id" id="tipo_produto" class="form-control" required>
                <option value="">Selecione</option>
                @foreach($tiposProduto as $tipo)
                    <option value="{{ $tipo->id_tipo_produto }}" {{ isset($produto) && $produto->tipo_produto_id == $tipo->id_tipo_produto ? 'selected' : '' }}>
                        {{ $tipo->tipo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Nome</label>
            <input type="text" name="nome_produto" class="form-control" value="{{ $produto->nome_produto ?? '' }}" required>
        </div>

        <div class="col-md-2">
            <label>Quantidade</label>
            <input type="number" id="quantidade" class="form-control" min="0" value="{{ $produto->quantidade ?? 0 }}" disabled>
        </div>

        <div class="col-md-2">
            <label>Custo</label>
            <input type="text" name="custo" class="form-control mask-decimal" value="{{ old('custo', isset($produto) ? number_format($produto->custo, 2, ',', '') : '') }}">
        </div>

        <div class="col-md-2">
            <label>Valor</label>
            <input type="text" name="valor" class="form-control mask-decimal" value="{{ old('valor', isset($produto) ? number_format($produto->valor, 2, ',', '') : '') }}">
        </div>
    </div>

    <div id="composicao-section" style="display: none">
        <hr>
        <h5>Composição do Produto</h5>
        <div id="composicao-itens">
            @if(isset($produto->composicao))
                @foreach($produto->composicao as $i => $comp)
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <select name="composicao[{{ $i }}][produto_simples_id]" class="form-control">
                                @foreach($produtosSimples as $ps)
                                    <option value="{{ $ps->id_produto }}" {{ $comp->produto_simples_id == $ps->id_produto ? 'selected' : '' }}>{{ $ps->nome_produto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="composicao[{{ $i }}][quantidade]" class="form-control" value="{{ $comp->quantidade }}" min="1">
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <button type="button" id="add-item" class="btn btn-sm btn-secondary">Adicionar Item</button>
    </div>

    <div class="mt-4 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">{{ isset($produto) ? 'Atualizar' : 'Criar' }}</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tipoProduto       = document.getElementById('tipo_produto');
        const custoInput        = document.getElementById('custo');
        const composicaoSection = document.getElementById('composicao-section');
        const composicaoItens   = document.getElementById('composicao-itens');
        const addItemBtn        = document.getElementById('add-item');

        tipoProduto.addEventListener('change', function () {
            const isComposto = this.value == 2;
            composicaoSection.style.display = isComposto ? 'block' : 'none';
            custoInput.readOnly = isComposto;
        });

        addItemBtn?.addEventListener('click', () => {
            const index = composicaoItens.children.length;
            const itemHTML = `
                <div class="row mb-2">
                    <div class="col-md-6">
                        <select name="composicao[${index}][produto_simples_id]" class="form-control">
                            @foreach($produtosSimples as $ps)
                                <option value="{{ $ps->id_produto }}">{{ $ps->nome_produto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="composicao[${index}][quantidade]" class="form-control" min="1">
                    </div>
                </div>`;
            composicaoItens.insertAdjacentHTML('beforeend', itemHTML);
        });

        if (tipoProduto.value == 2) tipoProduto.dispatchEvent(new Event('change'));

        document.querySelectorAll('.mask-decimal').forEach(function (input) {
            input.addEventListener('input', function (e) {
                let value = input.value;

                value = value.replace(/[^\d,]/g, '');

                const parts = value.split(',');
                if (parts.length > 2) {
                    value = parts[0] + ',' + parts[1];
                }

                input.value = value;
            });

            input.addEventListener('blur', function () {
                let value = input.value.replace(',', '.');

                if (!isNaN(value) && value !== '') {
                    value = parseFloat(value).toFixed(2).replace('.', ',');
                    input.value = value;
                }
            });
        });
    });
</script>
@endsection
