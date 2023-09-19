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
                <h1 class="titulo"><strong>Documentos do Estágio</strong></h1>
            </div>
            <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse">
                <div class="col-md-9 corpo p-2 px-3">
                    <table class="table">
                        <thead>
                            <tr class="table-head">
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">Data Limite</th>
                                <th scope="col" class="text-center">Data de Envio</th>
                                <th scope="col" class="text-center">Última data de atualização</th>
                                <th scope="col" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        @foreach ($lista_documentos as $lista_documento)
                            <tbody>
                                <td class="align-middle">{{ $lista_documento->titulo }}</td>
                                <td class="align-middle">A definir</td>
                                <td class="align-middle">
                                    @php
                                        $documento_enviado = $lista_documento->data_envio ?? null;
                                    @endphp
                                    @if ($documento_enviado)
                                        {{ date_format(date_create($documento_enviado), 'd/m/Y') }}
                                    @else
                                        Não enviado
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @php
                                        $documento_enviado = $lista_documento->data_atualizacao ?? null;
                                    @endphp
                                    @if ($documento_enviado)
                                        {{ date_format(date_create($documento_enviado), 'd/m/Y') }}
                                    @else
                                        Nunca atualizado
                                    @endif
                                </td>
                                @php
                                    switch ($lista_documento->id) {
                                        case 1:
                                            $rota = 'estagio.documentos.termo-de-encaminhamento';
                                            break;
                                        case 2:
                                            $rota = 'estagio.documentos.termo-de-compromisso';
                                            break;
                                        case 3:
                                            $rota = 'estagio.documentos.plano-de-atividades';
                                            break;
                                        case 4:
                                            $rota = 'estagio.documentos.ficha-frequencia';
                                            break;
                                        case 5:
                                            $rota = 'estagio.documentos.termo-de-encaminhamento';
                                            break;
                                        case 6:
                                            $rota = 'estagio.documentos.termo-de-encaminhamento';
                                            break;
                                        case 7:
                                            $rota = 'estagio.documentos.termo-de-encaminhamento';
                                            break;
                                        default:
                                            $rota = null;
                                            break;
                                    }
                                @endphp
                                <td class="align-middle">
                                    <a>
                                        <img src="{{ asset('images/information.svg') }}" title="Informações"
                                            alt="Info documento" style="height: 30px; width: 30px;">
                                    </a>
                                    @if ($documento_enviado)
                                        <a href="{{ route($rota, ['id' => $estagio->id, 'edit' => true]) }}">
                                            <img src="{{ asset('images/pencil.svg') }}" alt="Editar Documento"
                                                style="height: 30px; width: 30px;">
                                        </a>
                                    @else
                                        <a href="{{ route($rota, ['id' => $estagio->id]) }}">
                                            <img src="{{ asset('images/add_disciplina.svg') }}" alt="Preencher Documento"
                                                style="height: 30px; width: 30px;">
                                        </a>
                                    @endif
                                    @if ($documento_enviado)
                                        <a href="{{ route('visualizar.pdf', ['id' => $lista_documento->documento_id]) }}" target="_blank">
                                            <img src="{{ asset('images/listar_edital.svg') }}" alt="Documento Preenchido"
                                                style="height: 30px; width: 30px;">
                                        </a>
                                    @else
                                        <img src="{{ asset('images/listar_edital.svg') }}" alt="Documento Preenchido"
                                            style="height: 30px; width: 30px; opacity: 50%;" disabled>
                                    @endif
                                </td>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    @endcan
@endsection
