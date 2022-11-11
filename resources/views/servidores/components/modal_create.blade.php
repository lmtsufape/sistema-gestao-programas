<div class="modal fade" id="modal_create" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create">
      <div class="modal-header" >
        <h5 class="modal-title title" >Cadastro de servidor</h5>
        <button class="btn-close" data-bs-dismiss="modal" onClick="window.location.reload();" aria-label="Close"></button>
      </div>
      <form action="{{route("servidores.store")}}" method="post">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="">
              <label for="name" class="form-label">Nome</label>
              <input name="name" id="name" type="text" placeholder="Digite o nome" value="{{ old('name') }}"
                class="form-control input-modal-create @if(!empty($errors->create->first('name'))) is-invalid @endif">
                @if(!empty($errors->create->first('name')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->create->first('name')}} </strong>
                  </span>
                @endif
            </div>
          </div>
          <div class="row">
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="cpf" class="form-label">CPF</label>
              <input name="cpf" id="cpf" type="text" placeholder="Digite o CPF" value="{{ old('cpf') }}"
               class="form-control input-modal-create @if(!empty($errors->create->first('cpf'))) is-invalid @endif">
                @if(!empty($errors->create->first('cpf')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->create->first('cpf')}} </strong>
                  </span>
                @endif
            </div>
            <div class="col-sm- 12 col-md-6 mb-3">
                <label for="setor" class="form-label">Setor</label>
                <input name="setor" id="setor" type="text" placeholder="Digite o setor" value="{{ old('setor') }}"
                  class="form-control input-modal-create @if(!empty($errors->create->first('setor'))) is-invalid @endif">
                @if(!empty($errors->create->first('setor')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->create->first('setor')}} </strong>
                  </span>
                @endif
            </div>
          </div>
          <div class="row">
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="email" class="form-label">E-mail</label>
              <input name="email" id="email" type="text" placeholder="Digite o e-mail" value="{{ old('email') }}"
                class="form-control input-modal-create @if(!empty($errors->create->first('email'))) is-invalid @endif">
                @if(!empty($errors->create->first('email')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->create->first('email')}} </strong>
                  </span>
                @endif
            </div>
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="password" class="form-label">Senha</label>
              <input name="password" id="password" type="password" placeholder="Digite a senha"
                class="form-control input-modal-create @if(!empty($errors->create->first('password'))) is-invalid @endif">
                @if(!empty($errors->create->first('password')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->create->first('password')}} </strong>
                  </span>
                @endif
            </div>
          </div>
          <button type="submit" class="btn btn-primary submit-button" style="margin-top: 30px;">Cadastrar servidor</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(function () {
      $('#cpf').mask('000.000.000-00');
    });
</script>
