<div class="modal " id="modal_show_{{ $pivo->aluno->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Informações do Estudantes</p>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: start">
                <div class="mb-3">
                    <label class="tituloinfomodal form-label mt-3">Nome do aluno</label>
                    <div class="textoinfomodal"> {{ $pivo->aluno->nome_aluno }} </div>
                </div>
                <div class="mb-3">
                    <label class="tituloinfomodal form-label mt-3">Edital</label>
                    <div class="textoinfomodal"> {{ $pivo->edital->titulo_edital }}</div>
                </div>
                <div class="mb-3">

                    <label class="tituloinfomodal form-label mt-3">Início do edital</label>
                    <div class="textoinfomodal"> {{ date_format(date_create($pivo->data_inicio), 'd/m/Y') }} </div>
                </div>
                <div class="mb-3">

                    <label class="tituloinfomodal form-label mt-3">Fim do edital</label>
                    <div class="textoinfomodal"> {{ date_format(date_create($pivo->data_fim), 'd/m/Y') }}</div>
                </div>
                <div class="mb-3">

                    <label class="tituloinfomodal form-label mt-3">Bolsa</label>
                    <div class="textoinfomodal">{{ $pivo->bolsa }}</div>
                </div>
                <div class="mb-3">

                    <label class="tituloinfomodal form-label mt-3">Informações complementares</label>
                    <div class="textoinfomodal"> {{ $pivo->info_complementares }}</div>
                </div>


            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
</div>
<style>
    .btn {
        color: #fff;
        background: #34A853;
        border-color: #34A853;
        border-radius: 20px;
        width: 120px;
    }

    .btn:hover {
        background-color: #40b760;
        border-color: #40b760;
        color: #fff;
    }

    .link {
        background: #EEEEEE;
        border-radius: 13px;
        border: 1px #D3D3D3;
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding: 5px;
        margin: 2px;
        text-decoration: none;
        color: #2D3875;
    }

    .link:hover {
        text-decoration: none;
        color: #34A853;
    }
</style>
