@extends('templates.app')

@section('body')
    <style>
        pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 10px 4px;
        }

        .pagination a.active {
            background-color: #3B864F;
            color: white;
            border: 1px solid #3B864F;
        }

        .pagination a:hover:not(.active) {
            background-color: #34A853;
        }
    </style>


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
                @if (Auth::user()->typage->tipo_servidor != 'pro_reitor')
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
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">E-mail</th>
                                <th scope="col" class="text-center">CPF</th>
                                <th scope="col" class="text-center">Matrícula</th>
                                <th class="text-center">
                                    Ações
                                    <button type="button" class="infobutton" data-bs-toggle="modal"
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
                                    <td class="align-middle">{{ $orientador->user->name }}</td>
                                    <td class="align-middle">{{ $orientador->user->email }}</td>
                                    <td class="align-middle">{{ $orientador->cpf }}</td>
                                    <td class="align-middle">{{ $orientador->matricula }}</td>
                                    <td class="align-middle">
                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal_show_{{ $orientador->id }}">
                                            <img src="{{ asset('images/information.svg') }}" title="Informações"
                                                alt="Info professor" style="height: 30px; width: 30px;">
                                        </a>
                                        {{--  <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents_{{$orientador->id}}">
                                <img src="{{asset('images/document.png')}}" alt="Documento professor"  style="height: 30px; width: 30px;">

                                </a> --}}

                                        @if (Auth::user()->typage->tipo_servidor != 'pro_reitor')
                                            <a href=" {{ route('orientadors.edit', ['id' => $orientador->id]) }}">
                                                <img src="{{ asset('images/pencil.svg') }}" title="Editar"
                                                    alt="Editar professor" style="height: 30px; width: 30px;">
                                            </a>
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
                                @include('Orientador.components.modal_legenda')
                                @include('Orientador.components.modal_show', ['orientador' => $orientador])
                                @include('Orientador.components.modal_delete', [
                                    'orientador' => $orientador,
                                ])
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!--
                              <div style="background-color: #F2F2F2; border-radius: 10px; margin-top: 7px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
        width: 150px; height: 50%;">
                                <div style="align-self: center; margin-right: auto">
                                  <br>
                                  <h4 class="fw-bold" style="font-size: 15px; color:#2D3875;">Legenda dos ícones:</h4>
                                </div>

                                <div style="align-self: center; margin-right: auto">
                                  <div style="display: flex; margin: 10px">
                                    <a><img src="/images/info.png" alt="Informacoes" style="width: 20px; height: 20px;"></a>
                                    <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Informações</p>
                                  </div>
                                  {{--  <div style="display: flex; margin: 10px">
            <a><img src="/images/document.png" alt="Documentos" style="width: 20px; height: 20px;"></a>
            <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Documentos</p>
          </div>  --}}
                                </div>
                                <div style="align-self: center; margin-right: auto">
                                  <div style="display: flex; margin: 10px">
                                    <a><img src="/images/edit-outline-blue.png" alt="Editar" style="width: 20px; height: 20px;"></a>
                                    <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Editar</p>
                                  </div>
                                  <div style="display: flex; margin: 10px">
                                    <a><img src="{{ asset('images/delete.png') }}" alt="Deletar orientador" style="width: 20px; height: 20px;"></a>
                                    <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Deletar</p>
                                  </div>
                                  <div style="display: flex; margin: 10px">
                                    <a><img src="{{ asset('images/searchicon.png') }}" alt="Procurar" style="width: 20px; height: 20px;"></a>
                                    <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Pesquisar</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                                  -->
                {{-- <div style="margin: auto; width: 45%; padding: 10px;">
        <div class="pagination">
          <a href="#" style="border-radius: 15px; background: #131833; color: white;">Anterior</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">1</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">2</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">3</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">4</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">...</a>
          <a href="#" style="border-radius: 15px; background: #34A853; color: white;">15</a>
          <a href="#" style="border-radius: 15px; background: #131833; color: white;">Próximo</a>
        </div>
      </div>  --}}

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
