@extends("templates.app")

@section("body")
    
    <h1><strong>Programas</strong></h1>
    <div class="container">
        <form action="{{route("vinculos.index")}}" method="get">
            <button class="block-programas">
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">Todas as bolsas</h3>    
            </button>
        </form>
        
        <form action="{{route("vinculos.index")}}" method="get">
            <input name="programa" type="hidden" value="MONITORIA">
            <button class="block-programas">
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">Monitorias</h3>
            </button>
        </form>
        
        <form action="{{route("vinculos.index")}}" method="get">
            <input name="programa" type="hidden" value="TUTORIA">
            <button class="block-programas">
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">Tutorias</h3>
            </button>
        </form>

        <form action="{{route("vinculos.index")}}" method="get">
            <button class="block-programas">
                <input name="programa" type="hidden" value="PAVI">   
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">PAVI</h3>
            </button>
        </form>

        <form action="{{route("vinculos.index")}}" method="get">
            <button class="block-programas">
                <input name="programa" type="hidden" value="BIA">
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">BIA</h3>
            </button>
        </form>

        <form action="{{route("vinculos.index")}}" method="get">
            <button class="block-programas">
                <input name="programa" type="hidden" value="PET">
                <img src="{{asset("images/vinculo.png")}}" alt="Todas as bolsas"/>
                <h3 class="text-home">PET</h3>
            </button>
        </form>

        
    </div>
@endsection