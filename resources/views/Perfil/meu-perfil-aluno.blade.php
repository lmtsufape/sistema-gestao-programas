@extends("templates.app")

@section("body")

<div class="container-fluid" style="width: 70%; background: #FBFBFB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 10px 40px 30px 40px; margin-top:2rem;">
    <div class="container-fluid">
        <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
            <h1 style="color:#2D3875;"><strong>Meu Perfil</strong></h1>
        </div>
        {{--  editar perfil - botão  --}}
        <div style="display:flex; justify-content:center; margin-bottom: 10px;  gap: 20px; margin-top: 20px">
            <a href="{{url("/alunos/".$aluno->id."/editarmeuperfil")}}" class="btn btn-primary"
                style="background: #34A853; border-radius: 10px; border: none; width: auto; height: 40px; font-weight: 700; font-size: 18px;
                line-height: 22px;"> <img src="{{asset("images/edit-outline.png")}}" style="width: 25px; margin-bottom: 5px" alt="Editar aluno"> Editar Perfil</a>
        </div>
        <div>

    </div>

    @auth
        @if (auth()->user()->typage_type == "App\Models\Aluno")
            <div class="container-fluid" style="padding-top: 10px;">

                @if ($aluno->user->image)
                <img src="/images/fotos-perfil/{{ $aluno->user->image }}"  class="img-fluid" style="border-radius: 50%; width:150px; height:150px;" alt="Foto de perfil">
                @else
                <img src="/images/sem-foto-perfil.png"  class="img-fluid" style="border-radius: 50%; width:150px; height:150px;" alt="Foto de perfil">
                @endif

                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Nome:</label>
                <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$aluno->user->name}} </div>

                @if ( $aluno->name_social != null )
                    <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Nome Social:</label>
                    <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$aluno->name_social}} </div>
                @endif

                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">E-mail:</label>
                <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$aluno->user->email}} </div>

                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">CPF:</label>
                <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$aluno->cpf}} </div>

                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Semestre de Entrada:</label>
                <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$aluno->semestre_entrada}} </div>
            </div>

        @endif
        <br>
        <br>
    @endauth
</div>
<br>
<br>
@endsection
