@extends("templates.app")

@section("body")
@canany(['aluno'])

<h1>Documentos</h1>


<a href="{{ route('Estagio.estagios-aluno') }}">Termo de Encaminhamento</a>
<br>
<a href="{{ route('Estagio.estagios-aluno') }}">Termo de Compromisso</a>



@endcan

@endsection