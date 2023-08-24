@canany(['admin', 'pro_reitor', 'gestor'])
    <div class="modal" id="modal_show_{{ $programa->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-create p-2">
                <div class="modal-header border-0">
                    <p class="titulomodal">Informações do Programa</p>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: start">
                    <div class="mb-3">
                        <label for="nome_edit"
                            style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;"
                            class=" form-label mt-3">
                            Nome</label>

                        <div class="textoinfomodal">
                            {{ $programa->nome }}
                        </div>
                    </div>
                    <div class="mb-3">

                        <label for="nome_edit"
                            style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;"
                            class=" form-label mt-3">
                            Descrição</label>

                        <div class="textoinfomodal">
                            {{ $programa->descricao }}
                        </div>
                    </div>
                    <div class="mb-3">

                        <label for="nome_edit"
                            style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;"
                            class=" form-label mt-3">
                            Data de Início</label>

                        <div class="textoinfomodal">
                            {{ date_format(date_create($programa->data_inicio), 'd/m/Y') }}
                        </div>
                    </div>
                    <div class="mb-3">

                        <label for="nome_edit"
                            style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;"
                            class=" form-label mt-3">
                            Data de Fim</label>

                        <div class="textoinfomodal">
                            {{ date_format(date_create($programa->data_fim), 'd/m/Y') }}
                        </div>
                    </div>
                    <div class="mb-3">

                        <label for="nome_edit"
                            style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;"
                            class=" form-label mt-3">
                            Servidores</label>

                        <div class="textoinfomodal">
                            @if (count($programa->servidores))
                                @foreach ($programa->servidores as $servidor)
                                    {{ $servidor->user->name }}<br>
                                @endforeach
                            @else
                                Ainda não há servidores atribuidos ao programa
                            @endif

                        </div>
                    </div>

                    @if (!empty($errors->update->first('name')))
                        <span class="invalid-feedback d-block">
                            <strong> {{ $errors->update->first('name') }} </strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="modal-footer border-0">
            </div>
        </div>
    </div>
    </div>
@else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
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
