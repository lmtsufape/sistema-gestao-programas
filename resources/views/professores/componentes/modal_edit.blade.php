<div data-backdrop="static" data-keyboard="false" role="dialog" class="modal fade" id="modal_edit_{{$professor->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create">
      <div class="modal-header" >
        <h5 class="modal-title title">Editar professor</h5>
        <button class="btn-close" data-bs-dismiss="modal" onClick="window.location.reload();" aria-label="Close"></button>
      </div>
      <form action="{{route('professor.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$professor->id}}">
        <div class="modal-body">
          <div class="mb-3" style="">
            <label for="nome_edit" class="form-label">Nome</label>
            <input name="nome" id="nome_edit" type="text" placeholder="Digite o nome" value="{{old('nome', $professor->nome)}}"
            class="form-control input-modal-create @if(!empty($errors->update->first('nome'))) is-invalid @endif">
            @if(!empty($errors->update->first('nome')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('nome')}} </strong>
                  </span>
            @endif
          </div>
          <div class="row">
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="cpf_edit" class="form-label">CPF</label>
              <input name="cpf" id="cpf_edit" type="text" placeholder="Digite o CPF" value="{{old('cpf', $professor->cpf)}}"
              class="form-control input-modal-create @if(!empty($errors->update->first('cpf'))) is-invalid @endif">
              @if(!empty($errors->update->first('cpf')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('cpf')}} </strong>
                  </span>
              @endif
            </div> 

            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="siape_edit" class="form-label">SIAPE</label>
              <input name="siape" id="siape_edit" type="text" placeholder="Digite o SIAPE" value="{{old('siape', $professor->siape)}}"
              class="form-control input-modal-create @if(!empty($errors->update->first('cpf'))) is-invalid @endif">
              @if(!empty($errors->update->first('siape')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('siape')}} </strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="mb-3">
            <label for="email_edit" class="form-label">Email</label>
            <input name="email" id="email_edit" type="text" placeholder="Digite o email" value="{{ old('email', $professor->email) }}"
            class="form-control input-modal-create @if(!empty($errors->update->first('email'))) is-invalid @endif">
            @if(!empty($errors->update->first('email')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('email')}} </strong>
                  </span>
            @endif
          </div>
          <button type="submit" class="btn btn-primary submit-button" style="margin-top: 30px;">Salvar informações</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(function () {
      $('#cpf_edit').mask('000.000.000-00');
    });
</script>