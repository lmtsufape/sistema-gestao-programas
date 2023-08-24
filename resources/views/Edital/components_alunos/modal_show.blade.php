<div class="modal " id="modal_show_{{ $aluno->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-create p-2">
            <div class="modal-header border-0">
                <p class="titulomodal">Informações do Estudantes</p>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow: auto">
                <div class="mb-3">
                    <label class="tituloinfomodal form-label mt-3">Nome do aluno:</label>
                    <div class="textoinfomodal"> {{ $aluno->nome_aluno }} </div>

                    <label class="tituloinfomodal form-label mt-3">Edital:</label>
                    <div class="textoinfomodal"> {{ $edital->titulo_edital }}</div>

                    <label class="tituloinfomodal form-label mt-3">Início do edital:</label>
                    <div class="textoinfomodal"> {{ date_format(date_create($vinculo->data_inicio), 'd/m/Y') }} </div>

                    <label class="tituloinfomodal form-label mt-3">Fim do edital:</label>
                    <div class="textoinfomodal"> {{ date_format(date_create($vinculo->data_fim), 'd/m/Y') }}</div>

                    <label class="tituloinfomodal form-label mt-3">Bolsa:</label>
                    <div class="textoinfomodal">{{ $vinculo->bolsa }}</div>

                    <label class="tituloinfomodal form-label mt-3">Informações complementares:</label>
                    <div class="textoinfomodal"> {{ $vinculo->info_complementares }}</div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
