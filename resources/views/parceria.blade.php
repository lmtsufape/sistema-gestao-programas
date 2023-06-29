@extends("templates.app")


@section("body")
    @include("auth.modal_criar_aluno")

    {{-- <x-jet-validation-errors class="mb-4" />
    @if (session('status'))
        <div class="">
            {{ session('status') }}
        </div>
    @endif --}}
    @if (session('sucesso'))
    <div class="alert alert-sucess">
        <p style="color: green">{{session('sucesso')}}</p>
    </div>
    @endif
    <br>

    <div class="container" style="padding-top: 5%; padding-bottom: 5%;"">

        <div class="row" style="text-align: left;">
            <h1>A Parceria</h1>
            <h3>Projeto Cooperação Técnica: Construindo pontes no campo das tecnologias da comunicação e informação na educação e na gestão universitária: uma parceria entre a UFAPE e a UPE</h3>
            <h3>Apresentação</h3>
            <p>O projeto de cooperação técnica, entre as instituições UFAPE e UPE nasce da necessidade de aperfeiçoamento das questões tecnológicas que ambas instituições apresentam e de sua comunidade acadêmica. De modo geral, as ações de tais instituições visarão o desenvolvimento e qualificação de sistemas voltados para o ensino; desenvolvimento de jogos educacionais voltados à educação básica; viabilização do Laboratório Multidisciplinar de Tecnologias Sociais (LMTS) como um ambiente de formação inicial aos alunos da UPE. Desse modo, o projeto deverá suprir as demandas acadêmicas que os alunos terão, além do aprimoramento pedagógico e tecnológico dos indivíduos, a partir de um ambiente amplo e confortável para que essa ação ocorra.</p>

            <h3>Objetivos</h3>
            <ol style="padding-left: 5%;">
                <li>Desenvolver ou qualificar sistemas voltados para o ensino, pesquisa, extensão e gestão no contexto universitário.</li>
                <li>Desenvolver jogos digitais com foco no ensino de conteúdos curriculares para a educação infantil e anos iniciais do ensino fundamental e na perspectiva da iniciativa “Games for Change” (Games for Change).</li>
                <li>Viabilizar o Laboratório Multidisciplinar de Tecnologias Sociais como um espaço de formação inicial de estudantes da UPE.</li>
            </ol>

            <h3>Equipe</h3>
            <h6>Docentes UFAPE</h6>
            <ul style="padding-left: 5%;">
                <li>Prof. Dr. Anderson Fernandes de Alencar</li>
                <li>Prof. Dr. Igor Medeiros Vanderlei</li>
                <li>Prof. Dr. Jean Carlos Teixeira de Araújo</li>
                <li>Prof. Dr. Mariel José Pimentel de Andrade</li>
                <li>Prof. Dr. Rodrigo Gusmão de Carvalho Rocha</li>
            </ul>        
            <h6>Docentes UPE</h6>
            <ul style="padding-left: 5%;">            
                <li>Prof. Dr. Cleyton Mário de Oliveira</li>
                <li>Prof. Dr. Emanoel Francisco Sposito Barreiros</li>
                <li>Prof. Dr. Ernani Martins dos Santos</li>
                <li>Profa. Dra. Tarcia Regina da Silva</li>
            </ul>
            <h6>Discentes UFAPE</h6>
            <ul style="padding-left: 5%;">            
                <li>Aluno 1</li>
                <li>Aluno 1</li>
                <li>Aluno 1</li>
            </ul>
            <h6>Discentes UPE</h6>
            <ul style="padding-left: 5%;">            
                <li>Aluno 1</li>
                <li>Aluno 1</li>
                <li>Aluno 1</li>
                <li>Aluno 1</li>     
            </ul>


    </div>
        
</div>
@endsection
