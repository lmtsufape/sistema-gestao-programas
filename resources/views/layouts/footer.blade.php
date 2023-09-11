@section('css')
<!-- <link rel="stylesheet" href="/css/app.css"> -->
<link rel="stylesheet" href="../../../css/footer.css">
@endsection

<footer class="footer2">
    <div class="footer_sgpa">
        <a href="" class="footer_sgpa" title="Logo SGPA" target="_blank">
        <img src="{{asset('images/sgpa-branco 1.svg')}}" alt="Logo SGPA">
        </a>
    </div>
    <div class="footer_logo">
        <a href="http://ufape.edu.br/" class="footer_box" title="Site UFAPE" target="_blank">
            <img  class="footer_ufape" src="{{ asset('images/logo_ufape_vertical.png') }}" alt="Logo UFAPE">
        </a>
        <a href="http://lmts.uag.ufrpe.br/" class="footer_box" title="Site LMTS" target="_blank">
            <img  class="footer_lmts" src="{{ asset('images/logo_ufape_color.png') }}" alt="Logo LMTS">
        </a>
        <a href="https://upe.br/" class="footer_box" title="Site UPE" target="_blank">
            <img  class="footer_upe" src="{{ asset('images/logoupe.png') }}" alt="Logo UPE">
        </a>
    </div>
    <div class="footer_redes">
        <a href="https://www.facebook.com/LMTSUFAPE/" title="Facebook LMTS" target="_blank">
            <img src="{{asset('images/logo_facebook_branco.svg')}}" alt="Logo Facebook" ">
        </a>
        <a href="https://www.instagram.com/lmts_ufape/" title="Instagram LMTS" target="_blank">
            <img src="{{asset('images/logo_instagram_branco.svg')}}" alt="Logo Instagram" >
        </a>
        <a href="mailto:lmts@ufrpe.br" title="E-mail LMTS" target="_blank">
            <img src="{{asset('images/logo_google_branco.svg')}}" alt="Logo Google" >
        </a>
    </div>


</footer>