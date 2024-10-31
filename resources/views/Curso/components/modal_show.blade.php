@can('visualizar curso')
    <div class="modal " id="modal_show_{{ $curso->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-create p-2">
                <div class="modal-header border-0">
                    <p class="titulomodal">Informações do curso</p>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: start">
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3" for="nome_edit">Curso</label>
                        <div class="textoinfomodal"> {{ $curso->nome }} </div>
                        <br>

                        <label class="tituloinfomodal form-label mt-3" for="nome_edit">Disciplinas</label>
                        <div class="textoinfomodal">

                            @foreach ($curso->disciplinas as $disciplina)
                            <div class="textoinfomodal">{{ $disciplina->nome }}</div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
@endcan
