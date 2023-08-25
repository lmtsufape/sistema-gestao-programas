<div class="modal " id="modal_documents{{$orientador->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-create p-2">
                <div class="modal-header border-0">
                    <p class="titulomodal">Documentos do Orientador</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align: start">
        <div class="mb-3">
          <label for="plano_projeto" style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Plano de Trabalho</label>
          <div style="justify-content: flex-start; align-items: flex-start; display: flex; flex-direction: column; margin-top: 5px; margin-bottom: 5px;">
            <a href="{{ route('plano_trabalho.download', ['fileName' => $pivo->plano_projeto]) }}" target="_blank"  class="link">
              <img src="{{asset('images/bxs_download.png')}}" alt="baixar arquivo" style="width: 30px; height: 30px; margin-right: 5px;">
             Baixar
            </a>
            <br>
            <br>
          </div>

          @if($pivo->outros_documentos != null)
          <label for="outros_documentos" style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class="form-label mt-3">Outros Documentos</label>
          <div style="justify-content: flex-start; align-items: flex-start; display: flex; flex-direction: column; margin-top: 5px; margin-bottom: 5px;">
            <a href="{{ route('outros_documentos.download', ['fileName' => $pivo->outros_documentos]) }}" target="_blank"  class="link">
              <img src="{{asset('images/bxs_download.png')}}" alt="baixar arquivo" style="width: 30px; height: 30px; margin-right: 5px;">
             Baixar
            </a>
            <br>
            <br>
          </div>
          @endif
          <div class="modal-footer border-0">
          <button type="button" style="background: #34A853; border: #34A853;" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .link{
    color: #2D3875;
    border: #2D3875;
    margin-top: 5px;
    margin-bottom: 5px;
  }
  .link:hover{
    color: #34A853;
  }

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
