<div class="modal " id="modal_show_{{$edital->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-create p-2">
                <div class="modal-header border-0">
                    <p class="titulomodal">Informações do Edital</p>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align: start">
        <div class="mb-3">
          <label class="tituloinfomodal form-label mt-3">Data de início</label>
          <div class="textoinfomodal"> {{date_format(date_create($edital->data_inicio), "d/m/Y")}}</div>

          <label class="tituloinfomodal form-label mt-3">Data de fim</label>
          <div class="textoinfomodal"> {{date_format(date_create($edital->data_fim), "d/m/Y")}}</div>

          <label class="tituloinfomodal form-label mt-3">Programa</label>
          <div class="textoinfomodal">{{$edital->programa->nome}}</div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" style="background: #34A853; border: #34A853;" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .btn-secondary {
    color: #fff;
    background-color: #2d3875;
    border-color: #2d3875;
  }

  .btn-secondary:hover {
    background-color: #4353ab;
    border-color: #4353ab;
  }
</style>
