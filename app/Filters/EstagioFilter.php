<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstagioFilter
{
    public function apply(Builder $query, Request $request)
    {
        return $query->when($request->filled('obrigatoriedade'), function ($q) use ($request) { # Filtro obrigatoriedade
            $q->where('tipo', $request->obrigatoriedade ? 'eo' : 'eno');
        })->when($request->filled('status'), function ($q) use ($request) { # Filtro status
            $q->where('status', $request->status);
        })->when($request->filled('cursos'), function ($q) use ($request) { # Filtro cursos
            $q->whereIn('curso_id', $request->cursos);
        })->when($request->filled('disciplinas'), function ($q) use ($request) { # Filtro disciplinas
            $disciplinas_id = DB::table('disciplinas')->whereIn('nome', $request->disciplinas)->pluck('id');
            $q->whereIn('disciplina_id', $disciplinas_id);
        })->when($request->filled(['data_inicio_solicitacao', 'data_fim_solicitacao']), function ($q) use ($request) { # Filtro data de solicitação
            $q->whereDate('created_at', '>=', $request->data_inicio_solicitacao)->whereDate('created_at', '<=', $request->data_fim_solicitacao);
        })->when($request->filled('busca'), function ($q) use ($request) { # Filtro campo de busca
            foreach ($request->busca as $termo) {
                $q->where(DB::raw("unaccent(descricao)"), 'ilike', "%$termo%"); # Busca sem acentuação
            }
        });
    }
}
