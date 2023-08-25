@extends("templates.app")

@section("body")

<div class="container-fluid">
    @if (session('sucesso'))
    <div class="alert alert-sucess">
        {{session('sucesso')}}
    </div>
    @endif

    @if (session('falha'))
    <div class="alert alert-danger">
        {{session('falha')}}
    </div>
    @endif
    <br>


    <div class="title-position">
        <h1 class="titulo"><strong>Professores Vinculados</strong></h1>
    </div>

    <form class="search-container" action="" method="GET">
        <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title="" id="valor" name="valor" style="text-align: start">
        <input class="search-button" type="submit" value=""></input>
    </form>

    <br>
    <br>

    <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
        <div class="col-md-9 corpo p-2 px-3">
            <table class="table">
                <thead>
                    <tr class="table-head">
                        <th scope="col" class="text-center">Nome</th>
                        <th scope="col" class="text-center">Edital</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orientadores as $orientador)
                    @foreach ($pivot as $pivo)
                    <tr>
                        <td class="align-middle">{{ $orientador->name }}</td>
                        <td class="align-middle">{{ $pivo->titulo }}</td>
                        <td>


                            <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show{{$orientador->id}}">
                                <img src="{{asset('images/information.svg')}}" alt="Info Orientador" style="height: 30px; width: 30px;">
                            </a>

                            <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents{{$orientador->id}}">
                                <img src="{{asset('images/document.svg')}}" alt="Mostrar Documentos" style="height: 30px; width: 30px;">
                            </a>


                        </td>
                    </tr>
                </tbody>
                @include('Edital.components_orientadores.modal_show', ['orientador' => $orientador, 'pivo' => $pivo])
                @include('Edital.components_orientadores.modal_documents', ['orientador' => $orientador, 'pivo' => $pivo])
                @endforeach
                @endforeach
            </table>
        </div>
        <!--
    <div style="background-color: #F2F2F2; border-radius: 15px; justify-content: center; align-items: center
            ; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); width: 150px; height: 40%;">

      <div style="align-self: center; margin-right: auto">
        <br>
        <h4 class="fw-bold" style="font-size: 15px; color:#2D3875;">Legenda dos ícones:</h4>
      </div>
      <div style="align-self: center; margin-right: auto">
        <div style="display: flex; margin: 10px">
          <a><img src="/images/info.png" alt="Informacoes" style="width: 20px; height: 20px;"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Informações</p>
        </div>
        <div style="display: flex; margin: 10px">
          <a><img src="/images/document.png" alt="Documentos" style="width: 20px; height: 20px;"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Documentos</p>
        </div>
        <div style="display: flex; margin: 10px">
          <a><img src="{{asset("images/searchicon.png")}}" alt="Procurar" style="width: 20px; height: 20px;"></a>
          <p style="font-style: normal; font-weight: 400; font-size: 15px; line-height: 130%; margin:5px">Pesquisar</p>
        </div>
      </div>
    </div>
-->
    </div>
    <br>
    <br>
</div>

<script type="text/javascript">
    function exibirModalVisualizar(id) {
        $('#modal_show' + id).modal('show');
    }

    function exibirModalDocumentos(id) {
        $('#modal_documents' + id).modal('show');
    }
</script>


@endsection