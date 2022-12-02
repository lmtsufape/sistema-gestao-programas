<div data-backdrop="static" data-keyboard="false" role="dialog" class="modal fade" id="modal_edit_{{$aluno->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
    <div class="modal-content modal-create" style="background-color: #FFFFFF; padding: 0 10px;">
      <div class="modal-header" >
        <h5 style="color: #131833; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;">
        Informações do aluno</h5>
        <button class="btn-close" data-bs-dismiss="modal" onClick="window.location.reload();" aria-label="Close"></button>
      </div>
      <form action="{{route('alunos.update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$aluno->id}}">
        <div class="modal-body">
          <div class="mb-3" style="">
            <label for="nome_edit" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">
            Nome:</label>
            {{--  <input name="name" type="text" placeholder="Digite o nome" value="{{old('name', $aluno->user->name)}}"
            class="@if(!empty($errors->update->first('name'))) is-invalid @endif" 
            style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
            <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
            {{old('name', $aluno->user->name)}}</div>
            @if(!empty($errors->update->first('name')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('name')}} </strong>
                  </span>
            @endif
          </div>

          <div class="mb-3" style="">
              <label for="email_edit" class="form-label"
              style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">E-mail:</label>
              <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                {{old('name', $aluno->user->email)}}</div>
              {{--  <input name="email" type="text" placeholder="Digite o email" value="{{old('email', $aluno->user->email)}}"
              class="@if(!empty($errors->update->first('email'))) is-invalid @endif"
              style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
              @if(!empty($errors->update->first('email')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('email')}} </strong>
                  </span>
              @endif
            </div>

            <div class="row">
              {{--  <!-- TODO: Editar as infos do back -->  --}}
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="cpf_edit" class="form-label"style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">
                Instituição:</label>
                <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                  {{old('name', $aluno->cpf)}}</div>
              {{--  <input name="cpf" id="cpf_edit" type="text" placeholder="Digite a instituição" value="{{old('cpf', $aluno->cpf)}}"
              class="@if(!empty($errors->update->first('cpf'))) is-invalid @endif"
              style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
              @if(!empty($errors->update->first('cpf')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('cpf')}} </strong>
                  </span>
              @endif
            </div>
            
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="curso_edit" class="form-label"
              style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">
              Tipo de Vínculo:</label>
              <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                {{old('name', $aluno->curso)}}</div>
              {{--  <input name="curso" type="text" placeholder="Digite o curso" value="{{old('curso', $aluno->curso)}}"
              class="@if(!empty($errors->update->first('curso'))) is-invalid @endif"
              style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
              @if(!empty($errors->update->first('curso')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('curso')}} </strong>
                  </span>
              @endif
            </div>
          </div>

          <div class="row">
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="cpf_edit" class="form-label"style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">
                CPF:</label>
                <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                  {{old('name', $aluno->cpf)}}</div>
              {{--  <input name="cpf" id="cpf_edit" type="text" placeholder="Digite o CPF" value="{{old('cpf', $aluno->cpf)}}"
              class="@if(!empty($errors->update->first('cpf'))) is-invalid @endif"
              style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px"> --}}
              @if(!empty($errors->update->first('cpf')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('cpf')}} </strong>
                  </span>
              @endif
            </div>
            
            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="curso_edit" class="form-label"
              style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">
              Curso:</label>
              <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                {{old('name', $aluno->curso)}}</div>
              {{--  <input name="curso" type="text" placeholder="Digite o curso" value="{{old('curso', $aluno->curso)}}"
              class="@if(!empty($errors->update->first('curso'))) is-invalid @endif"
              style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
              @if(!empty($errors->update->first('curso')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('curso')}} </strong>
                  </span>
              @endif
            </div>
               

            {{--  <div class="col-sm- 12 col-md-6 mb-3">
              <label for="senha_edit" class="form-label" 
              style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Senha:</label>
              <input name="password" type="password" placeholder="Digite a senha"
              class="@if(!empty($errors->update->first('password'))) is-invalid @endif"
              style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
              @if(!empty($errors->update->first('password')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('password')}} </strong>
                  </span>
              @endif
            </div>   --}}

            <div class="col-sm- 12 col-md-6 mb-3">
              <label for="semestre_entrada_edit" class="form-label"
              style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">Semestre de entrada:</label>
              <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                {{old('semestre_entrada', $aluno->semestre_entrada)}}</div>
              {{--  <input name="semestre_entrada" id="semestre_entrada_edit" type="text" 
              placeholder="Digite o semestre de entrada" value="{{old('semestre_entrada', $aluno->semestre_entrada)}}"
              class="@if(!empty($errors->update->first('semestre_entrada'))) is-invalid @endif"
              style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
              @if(!empty($errors->update->first('semestre_entrada')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('semestre_entrada')}} </strong>
                  </span>
              @endif
            </div>
          </div>
          {{--  <button type="submit" class="btn btn-primary submit-button" style="margin-top: 30px; background-color: #2D3875;
          font-weight: 700; font-size: 20px; line-height: 29px;">Fechar</button>  --}}
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

<script type="text/javascript">
    $(function () {
      $('#semestre_entrada_edit').mask('0000.0');
    });
</script>