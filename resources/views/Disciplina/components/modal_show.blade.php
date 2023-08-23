@canany(['admin', 'servidor', 'gestor'])
    <div class="modal" id="modal_show_{{ $disciplina->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-create p-2">
                <div class="modal-header border-0">
                    <p class="titulomodal">Informações da Disciplina</p>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: start">
                    <div class="mb-5">
                        <label class="tituloinfomodal form-label mt-3">Disciplina</label>
                        <div class="textoinfomodal">{{ $disciplina->nome }}</div>
                    </div>

                    <div class="mb-5">
                        <label class="tituloinfomodal form-label mt-3">Curso</label>
                        <div class="textoinfomodal">{{ $disciplina->curso->nome }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elsecan
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/home') }}">Voltar</a>
@endcan
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
</style>
