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

    @endcan
@endsection
