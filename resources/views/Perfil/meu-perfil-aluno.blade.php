@extends("templates.app")

@section("body")

    <div class="container">
        <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
            <h1 style="color:#2D3875;"><strong>Meu Perfil</strong></h1>
        </div>
    </div>

    @auth
        @if (auth()->user()->typage_type == "App\Models\Aluno")
        <div class="container">
            <div style="background: #FBFBFB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 10px; padding: 10px 40px 30px 40px">
                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Nome:</label>
                <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$aluno->user->name}} </div>

                @if ( $orientador->name_social != null )
                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Nome Social:</label>
                <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$aluno->name_social}} </div>
                @endif

                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Email:</label>
                <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$aluno->user->email}} </div>

                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">CPF:</label>
                <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$aluno->cpf}} </div>

                <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Semestre de Entrada:</label>
                <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$aluno->semestre_entrada}} </div>


            </div>
        </div>
        @endif
    @endauth


@endsection
