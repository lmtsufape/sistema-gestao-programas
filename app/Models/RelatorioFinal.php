<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatorioFinal extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'caminho', 'edital_aluno_orientador_id', 'parecer', 'carga_horaria'];

    public const STATUS_ENUM = [
        'em_analise' => 1,
        'aprovado'   => 2,
        'devolvido'  => 3,
    ];

    /**
     * Retorna a chave do status (ex: 'aprovado') com base no valor inteiro.
     */
    public static function getStatusName(int $value): ?string
    {
        return array_search($value, self::STATUS_ENUM, true);
    }

    /**
     * Retorna o rótulo legível do status.
     */
    public static function getStatusLabel(string $key): ?string
    {
        return match ($key) {
            'em_analise' => 'Em análise',
            'aprovado'   => 'Aprovado',
            'devolvido'  => 'Devolvido',
            default      => null,
        };
    }

    /**
     * Accessor para obter a chave do status.
     */
    public function getStatusKeyAttribute(): ?string
    {
        return self::getStatusName($this->status);
    }

    /**
     * Accessor para obter o rótulo do status.
     */
    public function getStatusLabelAttribute(): ?string
    {
        $key = $this->status_key;
        return $key ? self::getStatusLabel($key) : null;
    }

    // No modelo RelatorioFinal
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            1 => 'blue',
            2 => 'green',
            3 => '#c36410',
            default => 'black',
        };
    }

    public function editalAlunoOrientador()
    {
        return $this->belongsTo(EditalAlunoOrientadors::class, 'edital_aluno_orientador_id');
    }
}
