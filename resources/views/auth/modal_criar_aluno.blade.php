<div class="modal fade" id="modal_create" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-create">
        <div class="modal-header" >
          <h5 class="modal-title title">Cadastro de aluno</h5>
          <button class="btn-close" data-bs-dismiss="modal" onClick="window.location.reload();" aria-label="Close"></button>
        </div>
        <form action="{{route("alunos.create")}}" method="post">
          @csrf
          <div class="modal-body">
            <div class="mb-3" style="">
              <label for="name" class="form-label">Nome</label>
              <input name="name"  id="name" type="text" placeholder="Digite o nome" value="{{ old('name') }}"
              class="form-control input-modal-create @if(!empty($errors->create->first('name'))) is-invalid @endif">
              @if(!empty($errors->create->first('name')))
                    <span class="invalid-feedback d-block">
                      <strong> {{$errors->create->first('name')}} </strong>
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
                <label for="curso" class="form-label">Curso</label>
                <input name="curso" id="curso" type="text" placeholder="Digite o curso" value="{{ old('curso') }}"
                class="form-control input-modal-create @if(!empty($errors->create->first('curso'))) is-invalid @endif">
                @if(!empty($errors->create->first('curso')))
                    <span class="invalid-feedback d-block">
                      <strong> {{$errors->create->first('curso')}} </strong>
                    </span>
                @endif
              </div>
  
              <div class="col-sm- 12 col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" id="email" type="text" placeholder="Digite o email" value="{{ old('email') }}"
                class="form-control input-modal-create @if(!empty($errors->create->first('email'))) is-invalid @endif">
                @if(!empty($errors->create->first('email')))
                    <span class="invalid-feedback d-block">
                      <strong> {{$errors->create->first('email')}} </strong>
                    </span>
                @endif
              </div>
  
              <div class="col-sm- 12 col-md-6 mb-3">
                <label for="password" class="form-label">Senha</label>
                <input name="password" id="password" type="password" placeholder="Digite a senha" value="{{ old('password') }}"
                class="form-control input-modal-create @if(!empty($errors->create->first('password'))) is-invalid @endif"> 
                @if(!empty($errors->create->first('password')))
                    <span class="invalid-feedback d-block">
                      <strong> {{$errors->create->first('password')}} </strong>
                    </span>
                @endif
              </div>
                
              <div class="col-sm- 12 col-md-6 mb-3">
                <label for="" class="form-label">Semestre de entrada</label>
                <input name="semestre_entrada" id="semestre_entrada" type="text" placeholder="Digite o semestre de entrada" value="{{ old('semestre_entrada') }}"
                class="form-control input-modal-create @if(!empty($errors->create->first('semestre_entrada'))) is-invalid @endif">
                @if(!empty($errors->create->first('semestre_entrada')))
                    <span class="invalid-feedback d-block">
                      <strong> {{$errors->create->first('semestre_entrada')}} </strong>
                    </span>
                @endif
              </div>
            </div>
            <button type="submit" class="btn btn-primary submit-button" style="margin-top: 30px;">Cadastrar aluno</button>
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
  
  <script type="text/javascript">
      $(function () {
        $('#semestre_entrada').mask('0000.0');
      });
  </script>