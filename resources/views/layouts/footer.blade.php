@section('css')
<!-- <link rel="stylesheet" href="/css/app.css"> -->
<link rel="stylesheet" href="../../../css/footer.css">
@endsection

<footer class="footer">
    <div  style="width: 100%" >
        <div class="container-fluid">
            <div class="row d-flex  justify-content-between" style="flex-wrap: wrap;">
                <!-- Logos à esquerda -->
                <div style="margin-top: 20px; padding-left: 10px; width: fit-content; ">
                    <div class="d-flex align-items-center justify-content-start">
                        <a href="" title="Logo do SGPA" target="_blank">
                            <img src="{{asset('images/sgpa-branco 1.svg')}}" alt="Logo SGPA" style="height: 60px;">
                        </a>
                    </div>
                </div>

                <!-- Logos do centro -->
                <div class="d-flex justify-content-between" style=" gap: 5%; margin-top: 14px; width: fit-content; ">
                    <a href="http://ufape.edu.br/" title="Ir para o site da UFAPE" target="_blank">
                        <img src="{{ asset('images/logo_ufape_vertical.png') }}" alt="Logo UFAPE" class="logo-box" style="height: 49.813px; width: 200.545px,flex-shrink 0; border-radius: 10px;">
                    </a>
                    <a href="http://lmts.uag.ufrpe.br/" title="Ir para o site do LMTS" target="_blank">
                        <img src="{{ asset('images/logo_ufape_color.png') }}" alt="Logo LMTS" class="logo-box" style="height: 49.813px; width: 200.545px,flex-shrink 0; border-radius: 10px;">
                    </a>
                    <a href="https://upe.br/" title="Ir para o site da UPE" target="_blank">
                        <img src="{{ asset('images/logoupe.png') }}" alt="Logo UPE" class="logo-box" style="height: 49.813px; width: 200.545px,flex-shrink 0 ; border-radius: 10px">
                    </a>
                </div>


                <!-- Logos à direita -->
                <div class="d-flex justify-content-between" style="align-self: center; gap: 5%; width: fit-content;">
                    <a href="https://www.facebook.com/LMTSUFAPE/" title="Facebook do LMTS" target="_blank">
                        <img src="{{asset('images/logo_facebook_branco.svg')}}" alt="Logo Facebook" style="height: 40px; padding-right:20px">
                    </a>
                    <a href="https://www.instagram.com/lmts_ufape/" title="Instagram do LMTS" target="_blank">
                        <img src="{{asset('images/logo_instagram_branco.svg')}}" alt="Logo Instagram" style="height: 40px; padding-right: 20px">
                    </a>
                    <a href="mailto:lmts@ufrpe.br" title="E-mail do LMTS" target="_blank">
                        <img src="{{asset('images/logo_google_branco.svg')}}" alt="Logo Google" style="height: 40px; padding-right: 20px">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>