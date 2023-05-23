@extends("templates.app")

@section("body")

    <div class="container">
        <div style="margin-bottom: 10px;  gap: 20px; margin-top: 20px">
            <h1 style="color:#2D3875;"><strong>Meu Perfil</strong></h1>
        </div>
    </div>

    @auth
        @if (auth()->user()->typage_type == "App\Models\Orientador")
        <div class="container">
            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Nome:</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$orientador->user->name}} </div>


            @if ( $orientador->name_social != null )
            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">Nome Social:</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">{{$orientador->name_social}}</div>
            @endif

            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">E-mail:</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$orientador->user->email}}</div>

            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">CPF:</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$orientador->cpf}}</div>

            <label style="display:flex; font-weight: 400; font-size: 20px; line-height: 28px; color: #131833; margin-bottom:8px;" class=" form-label mt-3">SIAPE:</label>
            <div style="background: #EEEEEE; border-radius: 13px; border: 1px #D3D3D3; width: 100%; padding: 5px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"> {{$orientador->matricula}}</div>

        </div>
        @endif
    @endauth


@endsection
