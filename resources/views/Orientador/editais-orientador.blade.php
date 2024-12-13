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

        .textolegenda {
            font-style: normal;
            font-weight: 400;
            font-size: 15px;
            line-height: 130%;
            margin: 5px
        }
    </style>



    <div style="display: flex; justify-content: space-evenly; align-items: center;">
        <h1 class="titulo"><strong>Editais vinculados ou abertos</strong></h1>
    </div>

    <form class="search-container" action="" method="GET">
        <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title="" id="valor" name="valor" style="text-align: start">
        <input class="search-button" title="Fazer a pesquisa" type="submit" value=""></input>
    </form>
    </div>
    <br>
    <br>
    <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
        <div class="col-md-9 corpo p-2 px-3">
            <table class="table">
                <thead>
                    <tr class="table-head">
                        <th scope="col" class="text-center align-middle">Título</i></th>
                        <th scope="col" class="text-center align-middle">Data de início</th>
                        <th scope="col" class="text-center align-middle">Data de fim</th>
                        <th scope="col" class="text-center align-middle">Programa</th>
                        <th scope="col" class="text-center align-middle">Discente</i></th>
                        <th scope="col" class="text-center align-middle">Status</i></th>
                        <th class="text-center">
                            Ações
                            <button type="button" class="infobutton align-bottom" data-bs-toggle="modal" data-bs-target="#modal_legenda" title="Ver legenda dos ícones">
                                <img src="{{ asset('images/infolegenda.svg') }}" alt="Legenda" style="height: 20px; width: 20px;">
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($editais as $edital)
                        <tr style="text-align: center;">
                            <td class="align-middle">{{ $edital['titulo'] }}</td>
                            <td class="align-middle">{{ $edital['data_inicio']->format('d/m/Y') }}</td>
                            <td class="align-middle">{{ $edital['data_fim']->format('d/m/Y') }}</td>
                            <td class="align-middle">{{ $edital['programa'] }}</td>
                            <td class="align-middle">{{ $edital['aluno']['nome'] ?? '-' }}</td>
                            <td class="align-middle">{{ $edital['tipo'] }}</td>
                            <td class="align-middle">
                                <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show{{ $edital['id'] }}">
                                    <img src="{{ asset('images/information.svg') }}" title="Informações do edital" alt="Info edital" style="height: 30px; width: 30px;">
                                </a>
                                @if ($edital['tipo'] === 'vinculado')
                                    <a type="button" href="{{ route('edital.add-documentos-vinculo', ['id' => $edital['id']]) }}">
                                        <img src="{{ asset('images/add_disciplina.svg') }}" title="Adicionar documentos" alt="Adicionar Documentos" style="height: 25px; width: 25px;">
                                    </a>
                                    @if ($edital['aluno']['termo'])
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents{{ $edital['aluno']['id'] }}">
                                            <img src="{{ asset('images/document.svg') }}" title="Ver documentos" alt="Documento aluno" style="height: 30px; width: 30px;">
                                        </a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @include('Edital.components_vinculos.modal_show', ['vinculo' => $edital])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
