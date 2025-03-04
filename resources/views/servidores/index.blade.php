@extends('templates.app')

@section('body')
    @can('listar servidor')

        <div class="container-fluid">
            @if (session('sucesso'))
                <div class="alert alert-success">
                    {{ session('sucesso') }}
                </div>
            @endif
            <br>

            <div style="display: flex; justify-content: space-evenly; align-items: center;">
                <h1 class="titulo"><strong>Servidores</strong></h1>
            </div>

            {{-- TODO: Falta adicionar um modal com os possiveis filtros  --}}
            <form class="search-container" action="{{ route('servidores.index') }}" method="GET">
                <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title=""
                    id="valor" name="valor" style="text-align: start">
                <button class="search-button" title="Fazer a pesquisa" type="submit" value=""></button>
                @can('cadastrar servidor')
                    <button class="cadastrar-botao" type="button"
                        onclick="window.location.href = '{{ route('servidores.create') }}'"">Cadastrar servidor</button>
                @endcan
            </form>

            <br>
            <br>

            @if (empty($servidores))
                <div class="empty">
                    <p>
                        Não há servidores cadastrados
                    </p>
                </div>
            @else
                <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
                    <div class="col-md-9 corpo p-2 px-3">
                        <table class="table">
                            <thead>
                                <tr class=table-head>
                                    <th scope="col" class="text-center align-middle">Nome</th>
                                    <th scope="col" class="text-center align-middle">E-mail</th>
                                    <th scope="col" class="text-center align-middle">CPF</th>
                                    <th scope="col" class="text-center align-middle">Tipo de Servidor</th>
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
                            <tbody>
                                @foreach ($servidores as $servidor)
                                    <tr>
                                        <td class="align-middle">{{ $servidor->user->name }}</td>
                                        <td class="align-middle">{{ $servidor->user->email }}</td>
                                        <td class="align-middle">{{ $servidor->cpf }}</td>
                                        <td>
                                            @foreach($servidor->user->roles as $key => $role)
                                                @switch($role->name)
                                                    @case('administrador')
                                                        <span>Administrador</span>
                                                    @break
                                            
                                                    @case('pro-reitor')
                                                        <span>Pró-Reitor</span>
                                                    @break
                                            
                                                    @case('tecnico')
                                                        <span>Técnico Administrativo</span>
                                                    @break
                                            
                                                    @case('diretor')
                                                        <span>Diretor</span>
                                                    @break

                                                    @case('supervisor')
                                                        <span>Supervisor</span>
                                                    @break

                                                    @case('coordenador')
                                                        <span>Coordenador</span>
                                                    @break
                                                @endswitch
                                        
                                                @if(!$loop->last)
                                                    <span>|</span>
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="align-middle">
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal_show_{{ $servidor->id }}">
                                                <img src="{{ asset('images/information.svg') }}" title="Informações"
                                                    alt="Info servidor" style="height: 30px; width: 30px;">
                                            </a>
                                            @can('editar servidor')
                                                <a type="button" href="{{ url('/servidores/' . $servidor->id . '/edit') }}">
                                                    <img src="{{ asset('images/pencil.svg') }}" title="Editar"
                                                        alt="Editar servidor" style="height: 30px; width: 30px;">
                                                </a>
                                            @endcan
                                            @can('deletar servidor')
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal_delete_{{ $servidor->id }}">
                                                    <img src="{{ asset('images/delete.svg') }}" title="Remover"
                                                        alt="Deletar servidor" style="height: 30px; width: 30px;">
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>

                                    @include('servidores.components.modal_legenda')
                                    @include('servidores.components.modal_delete', [
                                        'servidor' => $servidor,
                                    ])
                                    @include('servidores.components.modal_show', ['servidor' => $servidor])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif  
        </div>

        <script type="text/javascript">
            function exibirModalAdicionaPermissao(id) {
                $('#modal_adicionaPermissao' + id).modal('show');
            }

            function exibirModalDeletar(id) {
                $('#modal_delete' + id).modal('show');
            }

            function exibirModalVisualizar(id) {
                $('#modal_show' + id).modal('show');
            }
        </script>
    @else
        <h3 style="margin-top: 1rem">Você não possui permissão!</h3>
        <a class="btn btn-primary submit" style="margin-top: 1rem" href="{{ url('/login') }}">Voltar</a>
    @endcan
@endsection
