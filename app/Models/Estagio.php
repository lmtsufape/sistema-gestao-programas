<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Estagio extends Model
{
    use SoftDeletes;

    use Sortable;


    protected $fillable = [
        'descricao',
        'data_inicio',
        'data_fim',
        'data_solicitacao',
        'tipo',
        'status'
    ];

    protected $dates = [
        'data_inicio',
        'data_fim',

    ];

    public $sortable = [
        'status',
        'descricao',
        'created_at',
        'data_inicio',
        'data_fim',
        'curso_id',
        [
            'orientador.user.name',
            'path' => 'orientador.user.name',
        ],
        'aluno_id',
    ];

    public function scopeIniciadoEntre($query, $dataInicial, $dataFinal)
    {
        return $query->whereBetween('data_inicio', [$dataInicial, $dataFinal]);
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, "aluno_id");
        //return $this->belongsTo(Aluno::class, "cpf_aluno");
    }

    public function orientador()
    {
        return $this->belongsTo(Orientador::class, "orientador_id");
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, "curso_id");
    }

    /*public function servidor()
    {
        return $this->belongsTo(Servidor::class, "servidor_id");
    }*/

    // public function supervisor()
    // {
    //     return $this->belongsTo(Supervisor::class, "supervisor_id");;
    // }
}
