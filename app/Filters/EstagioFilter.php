<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstagioFilter
{
    public function apply(Builder $query, Request $request)
    {
        return $query
            ->when($request->filled('obrigatoriedade'), fn($q) => $this->filterObrigatoriedade($q, $request->obrigatoriedade))
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->when($request->filled('cursos'), fn($q) => $q->whereIn('curso_id', $request->cursos))
            ->when($request->filled('disciplinas'), fn($q) => $this->filterDisciplinas($q, $request->disciplinas))
            ->when($request->filled(['data_inicio_solicitacao', 'data_fim_solicitacao']), fn($q) => $this->filterDataSolicitacao($q, $request))
            ->when($request->filled('busca'), fn($q) => $this->filterBusca($q, $request->busca))
            ->when($request->filled('aluno'), fn($q) => $q->where('aluno_id', $request->aluno))
            ->when($request->filled('orientador'), fn($q) => $q->where('orientador_id', $request->orientador));
    }
    
    private function filterObrigatoriedade(Builder $query, $obrigatoriedade)
    {
        $tipo = $obrigatoriedade ? 'eo' : 'eno';
        $query->where('tipo', $tipo);
    }
    
    private function filterDisciplinas(Builder $query, $disciplinas)
    {
        $disciplinas_id = DB::table('disciplinas')->whereIn('nome', $disciplinas)->pluck('id');
        $query->whereIn('disciplina_id', $disciplinas_id);
    }
    
    private function filterDataSolicitacao(Builder $query, Request $request)
    {
        $query->whereDate('created_at', '>=', $request->data_inicio_solicitacao)
              ->whereDate('created_at', '<=', $request->data_fim_solicitacao);
    }
    
    private function filterBusca(Builder $query, $busca)
    {
        foreach ($busca as $termo) {
            $query->where(DB::raw("unaccent(descricao)"), 'ilike', "%$termo%");
        }
    } 
}
