<?php

namespace Database\Seeders;

use App\Models\ListaDocumentosObrigatorios;
use Illuminate\Database\Seeder;

class ListaDocumentosObrigatoriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Documentos da UPE

        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Termo de Encaminhamento",
            'descricao_documento' => "Termo de encaminhamento do aluno para o estágio.",
            'tipo_entrega' => "final",
            'tipo_estagio' => "eo",
            'instituicao' => "UPE"
        ]);

        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Termo de Compromisso",
            'descricao_documento' => "Documento que formaliza o início do estágio, com as informações do estagiário, da empresa e do supervisor de estágio.",
            'tipo_entrega' => "final",
            'tipo_estagio' => "eo",
            'instituicao' => "UPE"
        ]);

        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Plano de Atividades",
            'descricao_documento' => "Plano de atividades do estágio.",
            'tipo_entrega' => "final",
            'tipo_estagio' => "eo",
            'instituicao' => "UPE"
        ]);

        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Ficha de Frequência",
            'descricao_documento' => "Ficha de frequência do aluno.",
            'tipo_entrega' => "final",
            'tipo_estagio' => "eo",
            'instituicao' => "UPE"
        ]);

        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Relatório de Acompanhamento do Campo de Estágio",
            'descricao_documento' => "Relatório de Acompanhamento do Campo de Estágio.",
            'tipo_entrega' => "final",
            'tipo_estagio' => "eo",
            'instituicao' => "UPE"
        ]);

        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Relatório de Avaliação do Supervisor de Estágio",
            'descricao_documento' => "Relatório de avaliação do supervisor de estágio.",
            'tipo_entrega' => "final",
            'tipo_estagio' => "eo",
            'instituicao' => "UPE"
        ]);

        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Formulário de Frequência do Residente na Concedente",
            'descricao_documento' => "Formulário de Frequência do Residente na Concedente.",
            'tipo_entrega' => "final",
            'tipo_estagio' => "eo",
            'instituicao' => "UPE"
        ]);

        //Documentos da UFAPE

        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Termo de Compromisso",
            'descricao_documento' => "Documento que formaliza o início do estágio, com as informações do estagiário, da empresa e do supervisor de estágio.",
            'tipo_entrega' => "final",
            'tipo_estagio' => "eo",
            'instituicao' => "UFAPE"
        ]);

        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Carta de Aceite do Supervisor",
            'descricao_documento' => "Documento que formaliza a concordância do supervisor em assumir a responsabilidade de orientar o aluno",
            'tipo_entrega' => "final",
            'tipo_estagio' => "eo",
            'instituicao' => "UFAPE"
        ]);

        $documento = ListaDocumentosObrigatorios::create([
            'titulo' => "Ficha de Frequência",
            'descricao_documento' => "Ficha de frequência das atividades realizadas pelo aluno.",
            'tipo_entrega' => "final",
            'tipo_estagio' => "eo",
            'instituicao' => "UFAPE"
        ]);

        // $documento = ListaDocumentosObrigatorios::create([
        //     'titulo' => "Termo Aditivo",
        //     'descricao_documento' => "Ficha de frequência das atividades realizadas pelo aluno.",
        //     'tipo_entrega' => "final",
        //     'tipo_estagio' => "eo",
        //     'instituicao' => "UFAPE"
        // ]);



        
    }
}
