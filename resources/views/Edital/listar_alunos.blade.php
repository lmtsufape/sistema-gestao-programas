@extends('templates.app')

@section('body')
    <div class="container-fluid">
        @if (session('sucesso'))
            <div class="alert alert-sucess">
                {{ session('sucesso') }}
            </div>
        @endif

        @if (session('falha'))
            <div class="alert alert-danger">
                {{ session('falha') }}
            </div>
        @endif
        <br>


        <div class="title-position">
            <h1 class="titulo"><strong>Estudantes Vinculados</strong></h1>
        </div>


        <form class="search-container" action="" method="GET">
            <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title=""
                id="valor" name="valor" style="text-align: start">
            <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>
            @can('vincular estudante-edital')
                <button class="cadastrar-botao" type="button"
                    onclick="window.location.href = '{{ route('edital.show', ['id' => $edital->id]) }}'">Vincular
                    Estudantes</button>
            @endcan
        </form>

        <br>
        <br>

        <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
            <div class="col-md-9 corpo p-2 px-3">
                <table class="table">
                    <thead>
                        <tr class="table-head">
                            <th scope="col" class="text-center align-middle">Nome</th>
                            <th scope="col" class="text-center align-middle">Edital</th>
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
                       
                        @foreach ($vinculos as $vinculo)
                            <tr>
                                <td class="align-middle">{{ $vinculo->aluno->nome_aluno }}</td>
                                <td class="align-middle">{{ $vinculo->edital->titulo_edital }}</td>
                                <td>
                                    <a type="button" data-bs-toggle="modal"
                                        data-bs-target="#modal_show_{{ $vinculo->aluno->id }}"
                                        data-bs-id="{{ $vinculo->aluno->id }}">
                                        <img src="{{ asset('images/information.svg') }}" title="Informações"
                                            alt="Info edital" style="height: 30px; width: 30px;">
                                    </a>
                                    @can('editar vinculo estudante-edital')
                                        <a type="button"
                                                href="{{ route('edital.editar_vinculo', ['aluno_id' => $vinculo->aluno->id, 'edital_id' => $vinculo->edital->id]) }}">
                                                <img src="{{ asset('images/pencil.svg') }}" title="Editar" alt="Editar edital"
                                                    style="height: 30px; width: 30px;">
                                        </a>
                                    @endcan
                                    @can('desvincular estudante-edital')
                                        <a type="button"
                                        href="{{ route('edital.aluno.delete', ['id' => $vinculo->id]) }}">
                                        <img src="{{ asset('images/unlink.png') }}" title="Desvincular"
                                        alt="Deletar edital" style="height: 25px; width: 25px;">
                                        </a>
                                    @endcan
                                    <a type="button" data-bs-toggle="modal"
                                        data-bs-target="#modal_documents{{ $vinculo->aluno->id }}">
                                        <img src="{{ asset('images/document.svg') }}" title="Ver documentos"
                                            alt="Documento aluno" style="height: 30px; width: 30px;">
                                    </a>
                                    {{-- <a type="button" href="{{ route('termo_aluno.download', ['fileName' => $vinculo->termo_compromisso_aluno]) }}">Baixar PDF</a> --}}

                                </td>
                            </tr>
                            <!-- Modal show -->

                            @include('Edital.components_alunos.modal_legenda')
                            @include('Edital.components_alunos.modal_show', [
                                'aluno' => $vinculo->aluno,
                                'vinculo' => $vinculo,
                            ])
                            @include('Edital.components_alunos.modal_documents', [
                                'aluno' => $vinculo->aluno,
                                'vinculo' => $vinculo,
                            ])
                            <!-- Modal delete-->
                            @include('Edital.components_alunos.modal_delete', [
                                'aluno' => $vinculo->aluno,
                                'edital' => $vinculo->edital,
                                'vinculo' => $vinculo,
                            ])
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
        <br>
        <br>
    </div>


    <script type="text/javascript">
        function exibirModalDeletar(id) {
            $('#modal_delete_' + id).modal('delete');
        }

        function exibirModalVisualizar(id) {
            $('#modal_show_' + id).modal('show');
        }

        function exibirModalDocumentos(id) {
            $('#modal_documents' + id).modal('documents');
        }
    </script>
@endsection
