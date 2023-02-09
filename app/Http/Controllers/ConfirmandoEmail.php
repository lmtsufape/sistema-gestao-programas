<?php

namespace App\Http\Controllers;

use App\Mail\confirmEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConfirmandoEmail extends Controller
{
    private $nome;
    private $email;

    public function __construct(Request $request)
    {
        $this->nome = $request->nome;
        $this->email = $request->email;
    }

    public function enviandoEmail()
    {
        //$this->to($this->nome, $this->email);
        // Mail::send(confirmEmail(User));
        //return $this->markdown('mail.confirmEmail');

        $user = array('nome' => $this->nome, 'email' => $this->email);

        Mail::to(config('mail.from.address')) ->send(new confirmEmail($user));
    }
}
