<?php

namespace App\Exports;

use App\Models\Estagio;
use App\Models\User;
use App\Models\Disciplina;
use App\Models\Aluno;
use App\Models\Orientador;
use App\Models\Curso;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;

class EstagiosExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function map($row): array
    {
        $orientador = Orientador::where('id', $row->orientador_id)->first();
        $orientadorUser = User::where('cpf', $orientador->cpf)->first();
        // dd($orientadorUser);
        $disciplina = Disciplina::where('id', $row->disciplina_id)->first();
        $aluno = Aluno::where('id', $row->aluno_id)->first();
        $curso = Curso::where('id', $row->curso_id)->first();

        $status = $row->status ? 'ativo' : 'inativo';
        
        return [
            'id' => $row->id,
            'created_at' => Carbon::parse($row->created_at)->format('d/m/Y'),
            'updated_at' => Carbon::parse($row->updated_at)->format('d/m/Y'),
            'status' => $status,
            'descricao' => $row->descricao,
            'data_inicio' => Carbon::parse($row->data_inicio)->format('d/m/Y'),
            'data_fim' => Carbon::parse($row->data_fim)->format('d/m/Y'),
            'tipo' => $row->tipo,
            'aluno_id' => $aluno ? $aluno->nome_aluno : null,
            'orientador_id' => $orientadorUser ? $orientadorUser->name : null,
            'curso_id' => $curso ? $curso->nome : null,
            'disciplina_id' => $disciplina ? $disciplina->nome : null,
            'supervisor' => $row->supervisor,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'criado_em',
            'atualizado_em',
            'status',
            'descricao',
            'data_inicio',
            'data_fim',
            'tipo',
            'aluno',
            'orientador',
            'curso',
            'disciplina',
            'supervisor',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
