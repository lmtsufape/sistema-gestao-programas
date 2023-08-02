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



<div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
    <h1 style="color:#2D3875;"><strong>Meus Editais - Vínculos Ativos</strong></h1>
    <div style="margin: auto"></div>
    <form action="" method="GET">
        <input type="text" onkeyup="" placeholder="Digite a busca" title="" id="valor" name="valor" style="background-color: #D9D9D9;
              border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              background-position: 10px 2px;
              background-repeat: no-repeat;
              width: 35%;
              font-size: 16px;
              height: 45px;
              border: 1px solid #ddd;
              margin-bottom: 12px;  margin-right: 10px">

        <input type=" submit" value="" style="background-image: url('/images/searchicon.png');
              background-color: #D9D9D9;
              border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              width: 40px;
              font-size: 16px;
              height: 45px;
              border: 1px solid #ddd;
              position: absolute;
              margin: auto;" />
    </form>
</div>
<br>

<div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
    <div class="col-md-9 corpo p-2 px-3">
        <table class="table" style="border-radius: 10px; background-color: #F2F2F2;
        min-width: 600px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25); min-height: 50px; ">
           <thead>
          <tr>
            <th scope="col">Título</i></th>
            <th scope="col">Data de início</th>
            <th scope="col">Data de fim</th>
            <th scope="col">Programa</th>
            <th scope="col">Estudante</i></th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($vinculos as $vinculo)
          <tr>
            <td style="border-right: 1px solid #d3d3d3;">{{ $vinculo->edital->titulo_edital}}</td>
            <td style="border-right: 1px solid #d3d3d3;">{{date_format(date_create($vinculo->edital->data_inicio), "d/m/Y")}}</td>
            <td style="border-right: 1px solid #d3d3d3;">{{date_format(date_create($vinculo->edital->data_fim), "d/m/Y")}}</td>
            <td style="border-right: 1px solid #d3d3d3;">{{$vinculo->edital->programa->nome}}</td>
            <td style="border-right: 1px solid #d3d3d3;">{{$vinculo->aluno->user->name}}</td>
            <td>
            
              
              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_show{{$vinculo->id}}">
                <img src="{{asset("images/info.png")}}" alt="Info edital" style="height: 30px; width: 30px;">
              </a>
              <a href="{{route('edital.add-documentos-vinculo', ['id' => $vinculo->id]  )}}">
                <img src="{{asset("images/adicionar-documento.png")}}" alt="Adicionar Documentos" style="height: 30px; width: 30px;">
              </a>
              @if($vinculo->termo_aluno)  
              <a type="button" data-bs-toggle="modal" data-bs-target="#modal_documents{{$vinculo->id}}">
                <img src="{{asset('images/document.png')}}" alt="Termo do Aluno"  style="height: 30px; width: 30px;">
              </a>
              @endif
            </td>
          </tr>
          <tr>
            {{-- Não apagar esse tr  --}}
          </tr>
        </tbody>
        @include("Edital.components_vinculos.modal_show", ["vinculo" => $vinculo])
        @include('Edital.components_vinculos.modal_documents', ['vinculo' => $vinculo])
          
        @endforeach
                </tbody>
            </table>
        </div>

        <div style="background-color: #F2F2F2; border-radius: 10px; margin-top: 7px; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
            width: 150px; height: 50%;">
            <div style="align-self: center; margin-right: auto">
                <br>
                <h4 class="fw-bold" style="font-size: 15px; color:#2D3875;">Legenda dos ícones:</h4>
            </div>

            <div style="align-self: center; margin-right: auto">
                <div style="display: flex; margin: 10px">
                    <a><img src="/images/info.png" alt="Informacoes" style="width: 20px; height: 20px;"></a>
                    <p class="textolegenda">Informações</p>
                </div>
                <div style="display: flex; margin: 10px">
                    <a><img src="/images/adicionar-documento.png" alt="Adicionar Documentos" style="width: 20px; height: 20px;"></a>
                    <p class="textolegenda">Add Documentos</p>
                </div>
                <div style="display: flex; margin: 10px">
                    <a><img src="{{asset('images/searchicon.png')}}" alt="Procurar" style="width: 20px; height: 20px;"></a>
                    <p class="textolegenda">Pesquisar</p>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection
