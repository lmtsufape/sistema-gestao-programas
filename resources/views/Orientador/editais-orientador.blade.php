@extends("templates.app")

@section("body")

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
    <h1 class = "titulo"><strong>Meus Editais - Vínculos Ativos</strong></h1>
  </div>

    <form class="search-container" action="" method="GET">
        <input class="search-input" onkeyup="" type="text" placeholder="Digite a busca" title="" id="valor" name="valor" style="text-align: start">
        <input class="search-button" type="submit" value=""></input>
    </form>
</div>
<br>
<br>
<div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
    <div class="col-md-9 corpo p-2 px-3">
        <table class="table">
           <thead>
          <tr class ="table-head">
            <th scope="col" class="text-center">Título</i></th>
            <th scope="col" class="text-center">Data de início</th>
            <th scope="col" class="text-center">Data de fim</th>
            <th scope="col" class="text-center">Programa</th>
            <th scope="col" class="text-center">Estudante</i></th>
            <th scope="col" class="text-center">Ações</th>
          </tr>
        </thead>
        @foreach ($vinculos as $vinculo)
        <tbody>
          <tr style="text-align: center;">
            <td class="align-middle">{{ $vinculo->edital->titulo_edital}}</td>
            <td class="align-middle">{{date_format(date_create($vinculo->edital->data_inicio), "d/m/Y")}}</td>
            <td class="align-middle">{{date_format(date_create($vinculo->edital->data_fim), "d/m/Y")}}</td>
            <td class="align-middle">{{$vinculo->edital->programa->nome}}</td>
            <td class="align-middle">{{$vinculo->aluno->user->name}}</td>
            <td class="align-middle">
              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show{{$vinculo->id}}">
                <img src="{{asset("images/information.svg")}}" alt="Info edital" style="height: 30px; width: 30px;">
              </a>
              <a href="{{route('edital.add-documentos-vinculo', ['id' => $vinculo->id]  )}}">
                <img src="{{asset("images/add_disciplina.svg")}}" alt="Adicionar Documentos" style="height: 30px; width: 30px;">
              </a>
              @if($vinculo->termo_aluno)  
              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents{{$vinculo->id}}">
                <img src="{{asset('images/document.svg')}}" alt="Termo do Aluno"  style="height: 30px; width: 30px;">
              </a>
              @endif
            </td>
          </tr>
          <tr>
            {{-- Não apagar esse tr  --}}
          </tr>

        @include("Edital.components_vinculos.modal_show", ["vinculo" => $vinculo])
        @include('Edital.components_vinculos.modal_documents', ['vinculo' => $vinculo])
        @endforeach
        </tbody>
      </table>
    </div>
    </div>
</div>

@endsection
