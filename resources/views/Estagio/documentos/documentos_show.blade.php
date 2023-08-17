@extends("templates.app")

@section("body")
@canany(['aluno'])

<h1>Documentos</h1>


<a href="{{ route('estagio.documentos.termo-de-encaminhamento',['id' => $estagio->id])}}">Termo de Encaminhamento</a>
<br>

@endcan

@endsection