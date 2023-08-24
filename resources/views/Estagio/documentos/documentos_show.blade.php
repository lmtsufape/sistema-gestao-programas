@extends('templates.app')

@section('body')
    @canany(['aluno'])
        @if (Session::has('pdf_generated_success'))
            <div class="alert alert-success">
                {{ Session::get('pdf_generated_success') }}
            </div>
        @endif
        <h1>Documentos</h1>


        <a href="{{ route('estagio.documentos.termo-de-encaminhamento', ['id' => $estagio->id]) }}">Termo de Encaminhamento</a>
        <br>
        <br>
        <h1>Documentos preenchidos:</h1>
        @foreach ($documentos as $documento)
            <li>
                Documento: {{ $documento->titulo }}
                <a href="{{ route('visualizar.pdf', ['id' => $documento->id]) }}" target="_blank">Visualizar</a>
            </li>
        @endforeach
    @endcan
@endsection
