@can('visualizar estudante')
    <div data-backdrop="static" data-keyboard="false" role="dialog" class="modal" id="modal_edit_{{ $aluno->id }}"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-create p-2">
                <div class="modal-header border-0">
                    <p class="titulomodal">Informações do discente</p>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('home') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $aluno->id }}">
                    <div class="modal-body" style="text-align: start">

                        @if ($aluno->user->image)
                            <img src="/images/fotos-perfil/{{ $aluno->user->image }}" class="img-fluid profilepic mb-3"
                                alt="Foto de perfil">
                        @else
                            <img src="/images/sem-foto-perfil.png" class="img-fluid profilepic mb-3" alt="Foto de perfil">
                        @endif

                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3" for="nome_edit">Nome</label>
                            <div class="textoinfomodal">
                                {{ old('name', $aluno->user->name) }}</div>
                            @if (!empty($errors->update->first('name')))
                                <span class="invalid-feedback d-block">
                                    <strong> {{ $errors->update->first('name') }} </strong>
                                </span>
                            @endif
                        </div>

                        @if ($aluno->user->name_social != null)
                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Nome Social</label>
                            <div class="textoinfomodal">
                                {{ old('name', $aluno->user->name_social) }}
                            </div>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="email_edit" class="tituloinfomodal form-label">E-mail</label>
                            <div class="textoinfomodal">
                                {{ old('name', $aluno->user->email) }}</div>
                            @if (!empty($errors->update->first('email')))
                                <span class="invalid-feedback d-block">
                                    <strong> {{ $errors->update->first('email') }} </strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="cpf_edit" class="tituloinfomodal form-label">
                                CPF</label>
                            <div class="textoinfomodal">
                                {{ old('name', $aluno->user->cpf) }}</div>
                            @if (!empty($errors->update->first('cpf')))
                                <span class="invalid-feedback d-block">
                                    <strong> {{ $errors->update->first('cpf') }} </strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="curso_edit" class="tituloinfomodal form-label">
                                Curso</label>
                            <div class="textoinfomodal">
                                {{ old('name', $aluno->curso->nome) }}</div>
                            @if (!empty($errors->update->first('curso')))
                                <span class="invalid-feedback d-block">
                                    <strong> {{ $errors->update->first('curso') }} </strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="curso_edit" class="tituloinfomodal form-label"> Semestre de entrada</label>
                            <div class="textoinfomodal">{{ old('name', $aluno->semestre_entrada) }}</div>
                            @if (!empty($errors->update->first('semestra_entrada')))
                            <span class="invalid-feedback d-block">
                                <strong> {{ $errors->update->first('semestra_entrada') }} </strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="tituloinfomodal form-label mt-3">Orientadores</label>
                            <ul>
                                @foreach ($aluno->Orientadores->pluck('user.name') as $nome)
                                    <li>{{ $nome }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $('#cpf_edit').mask('000.000.000-00');
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('#semestre_entrada_edit').mask('0000.0');
        });
    </script>

@else
    <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
    <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/home') }}">Voltar</a>
@endcan
