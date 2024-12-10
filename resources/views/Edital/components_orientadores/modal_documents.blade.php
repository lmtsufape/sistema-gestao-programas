<div class="modal " id="modal_documents_{{ $vinculo->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create p-2">
      <div class="modal-header border-0">
        <p class="titulomodal">Documentos do Professor</p>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align: start">
        <div class="mb-3">
          <label class="tituloinfomodal form-label mt-3">Plano de Trabalho</label>
          <div class="baixar-arquivo">
            <a href="{{ route('plano_trabalho.download', ['fileName' => $vinculo->plano_projeto]) }}" target="_blank" class="link">
              <img src="{{asset('images/download.svg')}}" alt="baixar arquivo" style="width: 20px; height: 20px; margin-right: 5px;">
              Baixar
            </a>
            <br>
            <br>
          </div>

          @if($vinculo->outros_documentos != null)
          <label class="tituloinfomodal form-label mt-3">Outros Documentos</label>
          <div class="baixar-arquivo">
            <a href="{{ route('outros_documentos.download', ['fileName' => $vinculo->outros_documentos]) }}" target="_blank" class="link">
              <img src="{{asset('images/download.svg')}}" alt="baixar arquivo" style="width: 20px; height: 20px; margin-right: 5px;">
              Baixar
            </a>
            <br>
            <br>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  