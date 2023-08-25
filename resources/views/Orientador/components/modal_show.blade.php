@canany(['admin', 'servidor', 'pro_reitor', 'gestor'])
    <div class="modal " id="modal_show_{{ $orientador->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-create p-2">
                <div class="modal-header border-0">
                    <p class="titulomodal">Informações do Orientador</p>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: start">
                    @if ($orientador->user->image)
                        <img src="/images/fotos-perfil/{{ $orientador->user->image }}" class="img-fluid profilepic mb-3"
                            alt="Foto de perfil">
                    @else
                        <img src="/images/sem-foto-perfil.png" class="img-fluid profilepic mb-3" alt="Foto de perfil">
                    @endif
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3" for="nome_edit">Nome</label>
                        <div class="textoinfomodal"> {{ $orientador->user->name }}</div>
                    </div>
                    <div class="mb-3">
                        @if ($orientador->user->nome_social != null)
                            <label class="tituloinfomodal form-label mt-3" for="nome_edit">Nome Social</label>
                            <div class="textoinfomodal"> {{ $orientador->user->name_social }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3" for="nome_edit">CPF</label>
                        <div class="textoinfomodal"> {{ $orientador->cpf }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3" for="nome_edit">E-mail</label>
                        <div class="textoinfomodal">{{ $orientador->user->email }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3" for="nome_edit">Matrícula</label>
                        <div class="textoinfomodal"> {{ $orientador->matricula }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Curso(s)</label>
                        <div class="textoinfomodal">
                            @foreach ($orientador->cursos as $curso)
                                {{ $curso->nome }}<br>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="tituloinfomodal form-label mt-3">Instituição</label>
                        <div class="textoinfomodal"> {{ $orientador->instituicaoVinculo }}</div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @elsecan
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/home') }}">Voltar</a>
@endcan
