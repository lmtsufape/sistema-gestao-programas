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
    margin:5px
  }
</style>


<div class="container-fluid">
  
  <div style="display: flex; flex-direction:column;">
        <h1 class= "titulogrande"><strong>Modelos de documentos</strong></h1>
        <p class="titulopequeno">Aqui você pode visualizar os modelos de documentos disponíveis para download.</p>
  </div>

  <br>
  <br>

  <div class="d-flex flex-wrap justify-content-center" style="flex-direction: row-reverse;">
        <div class="col-md-9 corpo p-2 px-3">
            <table class="table">
                <thead>
                    <tr class= table-head>
                        <th scope="col" class="text-center">Nome</th>
                        <th scope="col" class="text-center">Descrição</th>
                        <th scope="col" class="text-center">Download</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class="align-middle">Modelo</td>
                        <td class="align-middle">Descrição do documento</td>
                        <td class="align-middle">Download</td>
                    </tr>

                </tbody>
            </table>
      </div>
    </div>

</div>
@endsection
