@component('mail::message')
<h1>Bem vindo ao nosso sistema usuário</h1>

@component('mail::button', ['url'=> 'http://127.0.0.1:8000/'])
Confirme aqui seu email
@endcomponent

<p> Obrigado por confirmar seu email</p>
@endcomponent
