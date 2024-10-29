<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstagioFilter
{
    public function apply(Builder $query, Request $request)
    {
        return $query->when($request->filled('obrigatoriedade'), function ($q) use ($request) {
            $q->where('tipo', $request->obrigatoriedade ? 'eo' : 'eno');
        })->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', $request->status);
        })->when($request->filled('cursos'), function ($q) use ($request) {
            $q->whereIn('curso_id', $request->cursos);
        })->when($request->filled('disciplinas'), function ($q) use ($request) {
            $disciplinas_id = DB::table('disciplinas')->whereIn('nome', $request->disciplinas)->pluck('id');
            $q->whereIn('disciplina_id', $disciplinas_id);
        })->when($request->filled(['data_inicio_solicitacao', 'data_fim_solicitacao']), function ($q) use ($request) {
            $q->whereDate('created_at', '>=', $request->data_inicio_solicitacao)->whereDate('created_at', '<=', $request->data_fim_solicitacao);
        });
    }
}
