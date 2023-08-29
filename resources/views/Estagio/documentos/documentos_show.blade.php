@extends('templates.app')

@section('body')

    @canany(['aluno'])
        <div class="container-fluid">
            @if (Session::has('pdf_generated_success'))
                <div class="alert alert-success">
                    {{ Session::get('pdf_generated_success') }}
                </div>
            @endif
            <br>
            <div style="display: flex; justify-content: space-evenly; align-items: center;">
             <h1 class = "titulo"><strong>Documentos do Estágio</strong></h1>
            </div>

            <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse">
                <div class="col-md-9 corpo p-2 px-3">
                    <table class="table">
                        <thead>
                            <tr class="table-head">
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">Data Limite</th>
                                <th scope="col" class="text-center">Data de Envio</th>
                                <th scope="col" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        @foreach ($lista_documentos as $lista_documento)
                            <tbody>
                                <td class="align-middle">{{ $lista_documento->titulo }}</td>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle">
                                    <a>
                                        <img src="{{asset('images/information.svg')}}" alt="Info documento" style="height: 30px; width: 30px;">
                                    </a>
                                    <a href="">
                                        <img src="{{asset('images/add_disciplina.svg')}}" alt="Preencher/Editar Documento" style="height: 30px; width: 30px;">
                                    </a>
                                    <a href="{{ route('visualizar.pdf', ['id' => $lista_documento->id]) }}">
                                        <img src="{{asset('images/listar_edital.svg')}}" alt="Documento Preenchido" style="height: 30px; width: 30px;">
                                    </a>
                                </td>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @endcan
@endsection
