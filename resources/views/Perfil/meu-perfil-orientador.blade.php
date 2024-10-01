@extends("templates.app")

@section("body")
<div class="fundocadastrar" style="width: 70%; background: #FBFBFB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 10px; margin-bottom: 50px; margin-top: 4rem;
                                    padding: 10px 40px 30px 40px; margin-top:2rem; border-radius: 15px; border: 1px solid var(--preto-p-50, #E6E6E6); background: var(--branco, #FFF); box-shadow: 0px 1px 9px 0px rgba(106, 32, 44, 0.13);">
    <div class="container-fluid">
        <div style="display: flex; width: 796px; flex-direction: column; justify-content: center; align-items: flex-start; gap: 10px;">
            <h1 style="color:#292323;"><strong>Meu Perfil</strong></h1>
        </div>

    </div>

    @auth
    @role('orientador')
        <div class="container-fluid" style="padding-top: 10px;">

            @if ($orientador->user->image)
            <div style="display: flex; align-items: center; gap: 20px; align-self: stretch;">
                <img src="/images/fotos-perfil/{{ $orientador->user->image }}" class="img-fluid" style="width: 80px; height: 80px; border-radius:50px" alt="Foto de perfil">
                <div style="color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;">{{$orientador->user->name_social}}</div>
            </div>
            @else
            <div style="display: flex; align-items: center; gap: 20px; align-self: stretch;">
                <img src="/images/sem-foto-perfil.png" class="img-fluid" style="width: 80px; height: 80px;" alt="Foto de perfil">
                <div style="color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;">{{$orientador->user->name_social}}</div>
            </div>
        </div>
    @endrole

    <br>

    <div style="display: flex; flex-direction: column;">
        <label style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-100, #6B6B6B); font-family: Inter; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; margin-top: 8px;">Nome completo</label>
        <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;"> {{$orientador->user->name}} </div>
    </div>

    <br>
    <!-- @if ( $orientador->name_social != null )
            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Nome Social:</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">{{$orientador->name_social}}</div>
            @endif -->

    <label style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-100, #6B6B6B); font-family: Inter; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal;" class=" form-label mt-3">E-mail:</label>
    <div style=" display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal; color: var(--preto-p-200, #2B2B2B); ">{{$orientador->user->email}}</div>

    <br>

    <div style="display: flex; flex-direction: column;">
        <label style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-100, #6B6B6B); font-family: Inter; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; margin-top: 8px;">CPF</label>
        <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;"> {{$orientador->cpf}}</div>

        <br>

        <div style="display: flex; flex-direction: column;">
            <label style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-100, #6B6B6B); font-family: Inter; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; margin-top: 8px;">Matrícula</label>
            <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px; color: var(--preto-p-200, #2B2B2B); font-family: Inter; font-size: 16px; font-style: normal; font-weight: 700; line-height: normal;">{{$orientador->matricula}}</div>

        </div>
        <br>
        <br>
        @endif
        {{-- editar perfil - botão  --}}
        <div style="display:flex; justify-content:right; margin-bottom: 10px;  gap: 20px; margin-top: 20px">
            <a href="{{url("/orientadors/".$orientador->id."/editarmeuperfil")}}" class="btn btn-primary" style="display: flex; padding: 8.5px 15.5px; align-items: center; gap: 6px; border-radius: 10px; border: 1.5px solid var(--teste-12, #BD8184); background-color: white; color: var(--teste-11, #972E3F);
                font-family: Inter; font-size: 12px; font-style: normal; font-weight: 700; line-height: normal; align-items: flex-end;">
                <img src="{{asset("images/lapis-editarperfil.png")}}" style="width: 20px; height: 20px;" alt="Editar servidor"> Editar</a>
        </div>
        @endauth
    </div>
    @endsection