<?php

namespace App\Http\Controllers;
use App\Models\Vinculo;
use App\Models\Frequencia_mensal;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function notificarPrazoFrequencia()
    {
        $vinculos = Vinculo::where('status', 'andamento')->get();

        foreach($vinculos as $vinculo){
            $email_params = ["professor" => $vinculo->professor, "aluno" => $vinculo->aluno, "vinculo" => $vinculo];
            Mail::send("email.prazo_frequencia_mensal", $email_params, function ($mail) use ($vinculo) {
                $mail->from("tjdvprogramaacademicos@gmail.com", "TJDV Programas Acadêmicos - UFAPE");
                $mail->subject("Notificação de prazo de frequência mensal");
                $mail->to($vinculo->aluno->user->email);
            });
        }

        return "E-mail enviado com sucesso!";
    }

    public function notificarPrazoRelatorio()
    {
        $vinculos = Vinculo::where('status', 'andamento')->get();

        foreach($vinculos as $vinculo){
            $email_params = ["professor" => $vinculo->professor, "aluno" => $vinculo->aluno, "vinculo" => $vinculo];
            Mail::send("email.prazo_relatorio_final", $email_params, function ($mail) use ($vinculo) {
                $mail->from("tjdvprogramaacademicos@gmail.com", "TJDV Programas Acadêmicos - UFAPE");
                $mail->subject("Notificação de prazo de relatório final");
                $mail->to($vinculo->aluno->user->email);
            });
        }

        return "E-mail enviado com sucesso!";
    }
}