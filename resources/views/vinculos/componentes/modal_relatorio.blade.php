<div class="modal fade" id="modal_relatorio_{{$vinculo->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content modal-create">
      <div class="modal-header">
        <h5 class="modal-title title">Relatório final</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route("vinculos.relatorio")}}" method="post" enctype="multipart/form-data" >
        @csrf
        <div class="modal-body">
          <div class="row justify-content-md-center">
            <div class="col-md-7 col-lg-7">
              <div class="form-group" style="text-align: left">
                <label for="select-file" class="form-label">Selecione o arquivo</label><br>
                <input id="select-file" type="file" name="relatorio">
              </div>
              <input type="hidden" value="{{$vinculo->id}}" name="id">
            </div>
            @if(!empty($vinculo->relatorio))
              <div class="col-md-3 col-lg-3">
                <a href="{{url("storage/{$vinculo->aluno->cpf}/{$vinculo->id}.pdf")}}" target="_blank" rel="noopener noreferrer">Clique para baixar o relatório.</a>
              </div>
            @else
              <div class="col-md-3 col-lg-3">
                <label>Vínculo ainda não possui relatório.</label>
              </div>
            @endif
          </div>
          <button type="submit" class="btn btn-primary submit-button" style="margin-top: 30px;">Enviar relatório</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  

</script>

