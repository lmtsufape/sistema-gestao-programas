@extends('templates.app')

@section('body')
    @can('listar estudante')
        <div class="container-fluid">
            @if (session('sucesso'))
                <div class="alert alert-success">
                    {{ session('sucesso') }}
                </div>
            @endif
            <br>


            <div style="display: flex; justify-content: space-evenly; align-items: center;">
                <h1 class="titulo"><strong>Discentes</strong></h1>
            </div>

            <form class="search-container" action="{{ route('alunos.index') }}" method="GET">
                <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title="" id="valor"
                    name="valor" style="text-align: start">
                <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>
                @can('cadastrar estudante')
                    <button class="cadastrar-botao" type="button"
                        onclick="window.location.href = '{{ route('alunos.create') }}'">Cadastrar discentes</button>
                @endcan
            </form>

            <br>
            <br>

            @if (sizeof($alunos) == 0)
                <div class="empty">
                    <p>
                        Não há alunos cadastrados
                    </p>
                </div>
            @else
                <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
                    <div class="col-md-9 corpo p-2 px-3">
                        <table class="table">
                            <thead>
                                <tr class=table-head>
                                    <th scope="col" class="text-center align-middle">Nome</th>
                                    <th scope="col" class="text-center align-middle">Nome Social</th>
                                    <th scope="col" class="text-center align-middle">CPF</th>
                                    <th scope="col" class="text-center align-middle">Curso</th>
                                    <th class="text-center">
                                        Ações
                                        <button type="button" class="infobutton align-bottom" data-bs-toggle="modal" data-bs-target="#modal_legenda" title="Ver legenda dos ícones">
                                            <img src="{{ asset('images/infolegenda.svg') }}" alt="Legenda" style="height: 20px; width: 20px;">
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($alunos as $aluno)
                                <tbody>
                                    <tr>
                                        <td class="align-middle">{{ $aluno->user->name }}</td>
                                        <td class="align-middle">{{ $aluno->user->name_social }}</td>
                                        <td class="align-middle">{{ $aluno->user->cpf }}</td>
                                        <td class="align-middle">{{ $aluno->curso->nome }}</td>
                                        <td class="align-middle">
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal_edit_{{ $aluno->id }}" title="Informações do discente">
                                                <img src="{{ asset('images/information.svg') }}" title="Informações" alt="Info aluno"
                                                    style="height: 30px; width: 30px;">
                                            </a>

                                            <a href="{{ route('alunos.edit', $aluno)}}" title="Editar o discente">
                                                <img src="{{ asset('images/pencil.svg') }}" title="Editar" alt="Editar aluno"
                                                    style="height: 30px; width: 30px;">
                                            </a>
                                            @can('deletar estudante')
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal_delete_{{ $aluno->id }}" title="Deletar o discente">
                                                    <img src="{{ asset('images/delete.svg') }}" title="Remover" alt="Deletar aluno"
                                                        style="height: 30px; width: 30px;">
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                    <tr></tr>
                                        @include('Alunos.components.modal_show', ['aluno' => $aluno])
                                        @include('Alunos.components.modal_delete', ['aluno' => $aluno])
                                        @include('Alunos.components.modal_legenda', ['aluno' => $aluno])
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
        </div>

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
                $('#modal_delete_' + id).modal('show');
            }

            function exibirModalVisualizar(id) {
                $('#modal_show_' + id).modal('show');
            }
        </script>

        <!--Exibindo erros de validacao ao criar -->
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

        <!--Exibindo erros de validacao ao editar -->
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
