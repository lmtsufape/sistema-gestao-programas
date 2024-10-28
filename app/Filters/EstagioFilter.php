<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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
        });
    }
}
