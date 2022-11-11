<div data-backdrop="static" data-keyboard="false" role="dialog" class="modal fade" id="modal_edit_{{$servidor->id}}" tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create">
      <div class="modal-header" >
        <h5 class="modal-title title">Editar servidor</h5>
        <button class="btn-close" data-bs-dismiss="modal" onClick="window.location.reload();" aria-label="Close"></button>
      </div>
      <form action="{{route('servidor.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$servidor->id}}">
        <div class="modal-body">
        <div class="row">
            <div class="">
              <label for="nome_edit" class="form-label">Nome</label>
              <input name="name" type="text" placeholder="Digite o nome" value="{{old('name', $servidor->user->name)}}"
              class="form-control input-modal-create @if(!empty($errors->update->first('name'))) is-invalid @endif">
                @if(!empty($errors->update->first('name')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('name')}} </strong>
                  </span>
                @endif
            </div>
          </div>
          <div class="row">
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="cpf_edit" class="form-label">CPF</label>
              <input name="cpf" id="cpf_edit" type="text" placeholder="Digite o CPF" value="{{old('cpf', $servidor->cpf)}}"
                class="form-control input-modal-create @if(!empty($errors->update->first('cpf'))) is-invalid @endif">
                @if(!empty($errors->update->first('cpf')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('cpf')}} </strong>
                  </span>
                @endif
              </div> 
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="setor_edit" class="form-label">Setor</label>
              <input name="setor" type="text" placeholder="Digite o setor" value="{{old('setor', $servidor->setor)}}"
              class="form-control input-modal-create @if(!empty($errors->update->first('setor'))) is-invalid @endif">
                @if(!empty($errors->update->first('setor')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('setor')}} </strong>
                  </span>
                @endif
            </div>
          </div>
          <div class="row">
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="email_edit" class="form-label">E-mail</label>
              <input name="email" type="text" placeholder="Digite o e-mail" value="{{old('email', $servidor->user->email)}}"
              class="form-control input-modal-create @if(!empty($errors->update->first('email'))) is-invalid @endif">
              @if(!empty($errors->update->first('email')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('email')}} </strong>
                  </span>
                @endif
            </div>
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="password_edit" class="form-label">Senha</label>
              <input name="password" type="password" placeholder="Digite a senha"
              class="form-control input-modal-create @if(!empty($errors->update->first('password'))) is-invalid @endif">
              @if(!empty($errors->update->first('password')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('password')}} </strong>
                  </span>
                @endif
            </div>
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
