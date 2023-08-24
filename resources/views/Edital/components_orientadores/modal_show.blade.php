<div class="modal " id="modal_show{{$orientador->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
    <div class="modal-content modal-create p-3" style="border-radius: 15px; background-color: #F9F9F9; font-family: 'Roboto', sans-serif;">
      <div class="modal-header">
        <h5 style="color: #2D3875; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px; text-align: center;" class="modal-title title fw-bold">Informações do Professor</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="overflow: auto">
        <div class="mb-3">
          <label class="tituloinfomodal form-label mt-3">Nome :</label>
          <div class="textoinfomodal"> {{  $orientador->name  }} </div>

          <label class="tituloinfomodal form-label mt-3">Edital:</label>
          <div class="textoinfomodal"> {{  $pivo->titulo }}</div>

          <label class="tituloinfomodal form-label mt-3">Data de início:</label>
          <div class="textoinfomodal"> {{  date('d/m/Y', strtotime($pivo->data_inicio)) }} </div>

          <label class="tituloinfomodal form-label mt-3">Data de fim:</label>
          <div class="textoinfomodal"> {{  date('d/m/Y', strtotime($pivo->data_fim)) }} </div>



        </div>
        <div class="modal-footer">
          <button type="button"  class="btn" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .btn {
    color: #fff;
    background: #34A853;
    border-color: #34A853;
    border-radius: 20px;
    width:120px;
  }

  .btn:hover {
    background-color: #40b760;
    border-color: #40b760;
    color: #fff;
  }

  .link{
    background: #EEEEEE;
    border-radius: 13px;
    border: 1px #D3D3D3;
    width: 100%;
    display:flex;
    flex-direction:row;
    flex-wrap:wrap;
    justify-content:center;
    align-items:center;
    padding:5px;
    margin:2px;
    text-decoration: none;
    color: #2D3875;
  }

  .link:hover{
    text-decoration: none;
    color:#34A853;
  }
</style>
