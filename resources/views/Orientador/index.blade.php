@extends('templates.app')

@section('body')


    @canany(['admin', 'servidor', 'pro_reitor', 'gestor'])
        <div class="container-fluid">
            @if (session('sucesso'))
                <div class="alert alert-success">
                    {{ session('sucesso') }}
                </div>
            @endif
            <br>

            <div style="display: flex; justify-content: space-evenly; align-items: center;">
                <h1 class="titulo"><strong>Professores</strong></h1>
            </div>

            {{-- TODO: Falta adicionar um modal com os possiveis filtros  --}}
            <form class="search-container" action="{{ route('orientadors.index') }}" method="GET">
                <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title=""
                    id="valor" name="valor" style="text-align: start">
                <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>
                @if (auth()->user()->typage->tipo_servidor != 'pro_reitor' && auth()->user()->typage->tipo_servidor != 'gestor')
                    <button class="cadastrar-botao" type="button"
                        onclick="window.location.href = '{{ route('orientadors.create') }}'">Cadastrar professor</button>
                @endif
            </form>

        </div>

        <br>
        <br>

        @if (sizeof($orientadors) == 0)
            <div class="empty">
                <p>
                    Não há professores cadastrados
                </p>
            </div>
        @else
            <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
                <div class="col-md-9 corpo p-2 px-3">
                    <table class="table">
                        <thead>
                            <tr class="table-head">
                                <th scope="col" class="text-center align-middle">Nome</th>
                                <th scope="col" class="text-center align-middle">E-mail</th>
                                <th scope="col" class="text-center align-middle">CPF</th>
                                <th scope="col" class="text-center align-middle">Matrícula</th>
                                <th class="text-center">
                                    Ações
                                    <button type="button" class="infobutton align-bottom" data-bs-toggle="modal"
                                        data-bs-target="#modal_legenda" title="Ver legenda dos ícones">
                                        <img src="{{ asset('images/infolegenda.svg') }}" alt="Legenda"
                                            style="height: 20px; width: 20px;">
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        @foreach ($orientadors as $orientador)
                            <tbody>
                                <tr>
                                    <td class="align-middle">{{ $orientador->user->name ?? 'Não encontrado' }}</td>
                                    <td class="align-middle">{{ $orientador->user->email ?? 'Não encontrado' }}</td>
                                    <td class="align-middle">{{ $orientador->cpf ?? 'Não encontrado' }}</td>
                                    <td class="align-middle">{{ $orientador->matricula ?? 'Não encontrado' }}</td>
                                    <td class="align-middle">
                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal_show_{{ $orientador->id }}">
                                            <img src="{{ asset('images/information.svg') }}" title="Informações"
                                                alt="Info professor" style="height: 30px; width: 30px;">
                                        </a>
                                        {{--  <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents_{{$orientador->id}}">
                                <img src="{{asset('images/document.png')}}" alt="Documento professor"  style="height: 30px; width: 30px;">

                                </a> --}}


                                        <a href=" {{ route('orientadors.edit', ['id' => $orientador->id]) }}" type="button">
                                            <img src="{{ asset('images/pencil.svg') }}" title="Editar"
                                                alt="Editar professor" style="height: 30px; width: 30px;">
                                        </a>
                                        @if (auth()->user()->typage->tipo_servidor != 'pro_reitor' && auth()->user()->typage->tipo_servidor != 'gestor')
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal_delete_{{ $orientador->id }}">
                                                <img src="{{ asset('images/delete.svg') }}" title="Remover"
                                                    alt="Deletar professor" style="height: 30px; width: 30px;">
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    {{--  nao apagar o tr  --}}
                                </tr>
                                @include('Orientador.components.modal_show', ['orientador' => $orientador])
                                @include('Orientador.components.modal_legenda')
                                @include('Orientador.components.modal_delete', [
                                    'orientador' => $orientador,
                                ])
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <br>
            <br>
        @endif
        </div>
        <script type="text/javascript">
            function exibirModalEditar(id) {
                $('#modal_edit_' + id).modal('show');
            }

            function exibirModalDeletar(id) {
                $('#modal_delete_denied' + id).modal('show');
            }

            function exibirModalVisualizar(id) {
                $('#modal_show_' + id).modal('show');
            }
        </script>

        <!-- Exibindo erros de validacao ao criar -->
        @if (count($errors->create) > 0)
            <script type="text/javascript">
                $(function() {
                    // Bloqueando o usuario na tela de modal apos falha na validacao.
                    // Forcando ele a clicar no botao de fechar, para limpar os erros
                    $("#modal_create").modal({
                        backdrop: "static",
                        keyboard: false
                    });
                    $("#modal_create").modal('show');
                });
            </script>
        @endif

        <!-- Exibindo erros de validacao ao editar -->
        @if (count($errors->update) > 0)
            <script type="text/javascript">
                $(function() {
                    // Bloqueando o usuario na tela de modal apos falha na validacao.
                    // Forcando ele a clicar no botao de fechar, para limpar os erros
                    $("#modal_edit_{{ old('id') }}").modal({
                        backdrop: "static",
                        keyboard: false
                    });
                    $("#modal_edit_{{ old('id') }}").modal('show');
                });
            </script>
        @endif
    @else
        <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
    @endcan
@endsection
