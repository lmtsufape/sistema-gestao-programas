<div class="modal fade" id="modal_create" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-create">
      <div class="modal-header" >
        <h5 class="modal-title title" >Cadastro de professor</h5>
        <button class="btn-close" data-bs-dismiss="modal" onClick="window.location.reload();" aria-label="Close"></button>
      </div>
      <form action="{{route("professores.store")}}" method="post">
        @csrf
        <div class="modal-body">
          <div class="mb-3" style="">
            <label for="nome" class="form-label">Nome</label>
            <input name="nome" id="nome" type="text" placeholder="Digite o nome" value="{{ old('nome') }}"
            class="form-control input-modal-create @if(!empty($errors->create->first('nome'))) is-invalid @endif">
            @if(!empty($errors->create->first('nome')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->create->first('nome')}} </strong>
                  </span>
            @endif
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
              <label for="siape" class="form-label">SIAPE</label>
              <input name="siape" id="siape" type="text" placeholder="Digite o SIAPE" value="{{ old('siape') }}"
              class="form-control input-modal-create @if(!empty($errors->create->first('siape'))) is-invalid @endif">
              @if(!empty($errors->create->first('siape')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->create->first('siape')}} </strong>
                  </span>
              @endif
            </div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" id="email" type="text" placeholder="Digite o email" value="{{ old('email') }}"
            class="form-control input-modal-create @if(!empty($errors->create->first('email'))) is-invalid @endif">
            @if(!empty($errors->create->first('email')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->create->first('email')}} </strong>
                  </span>
            @endif
          </div>
          <button type="submit" class="btn btn-primary submit-button" style="margin-top: 30px;">Cadastrar professor</button>
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
