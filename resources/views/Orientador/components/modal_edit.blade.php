<div data-backdrop="static" data-keyboard="false" role="dialog" class="modal fade" id="modal_edit_{{$orientador->id}}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- div antes do real modal -->
    <div class="modal-content modal-create" style="background-color: #FFFFFF; padding: 0 10px;">
      <div class="modal-header" >
        <h5 style="color: #131833; font-style: normal; font-weight: 600; font-size: 30px; line-height: 47px;">
        Informações do orientador</h5>
        <button class="btn-close" data-bs-dismiss="modal" onClick="window.location.reload();" aria-label="Close"></button>
      </div>
      <form action="{{route('home')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$orientador->id}}">
        <div class="modal-body">
          <div class="mb-3" style="">
            <label for="nome_edit" style="display:flex; font-weight: 600; font-size: 20px; line-height: 28px; color: #131833;">
            Nome:</label>
            {{--  <input name="name" type="text" placeholder="Digite o nome" value="{{old('name', $orientador->user->name)}}"
            class="@if(!empty($errors->update->first('name'))) is-invalid @endif" 
            style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
            <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
            {{old('name', $orientador->user->name)}}</div>
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
                {{old('name', $orientador->user->email)}}</div>
              {{--  <input name="email" type="text" placeholder="Digite o email" value="{{old('email', $orientador->user->email)}}"
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
                CPF:</label>
                <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                  {{old('name', $orientador->cpf)}}</div>
              {{--  <input name="cpf" id="cpf_edit" type="text" placeholder="Digite o cpf" value="{{old('cpf', $orientador->cpf)}}"
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
              Matrícula:</label>
              <div style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">
                {{old('name', $orientador->matricula)}}</div>
              {{--  <input name="curso" type="text" placeholder="Digite o curso" value="{{old('curso', $orientador->curso)}}"
              class="@if(!empty($errors->update->first('curso'))) is-invalid @endif"
              style="background: #F5F5F5; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px">  --}}
              @if(!empty($errors->update->first('matricula')))
                  <span class="invalid-feedback d-block">
                    <strong> {{$errors->update->first('matricula')}} </strong>
                  </span>
              @endif
            </div>
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