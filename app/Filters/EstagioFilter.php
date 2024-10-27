<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EstagioFilter
{
    public function apply(Builder $query, Request $request)
    {
        return $query->when($request->filled('obrigatoriedade'), function ($q) use ($request) {
            $obrigatoriedade = $request->obrigatoriedade ? 'eo' : 'eno';
            $q->where('tipo', $obrigatoriedade);
        })->when($request->filled('status'), function ($q) use ($request) {
            $status = $request->status;
            $q->where('status', $status);
        });
    }
}
