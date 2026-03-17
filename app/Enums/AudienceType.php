<?php

namespace App\Enums;

enum AudienceType: string
{
    case DISCENTE = 'discente';
    case DOCENTE = 'docente';
    case TECNICO = 'tecnico';
    case GESTAO = 'gestor';
    case COMUNIDADE_EXTERNA = 'comunidade_externa';
    case EGRESSO = 'egresso';
    case TRANSPOSICAO = 'transposicao';

    public function label(): string
    {
        return match ($this) {
            self::DISCENTE => 'Discente',
            self::DOCENTE => 'Docente',
            self::TECNICO => 'Técnico Administrativo',
            self::GESTAO => 'Gestão',
            self::COMUNIDADE_EXTERNA => 'Comunidade Externa',
            self::EGRESSO => 'Egresso',
            self::TRANSPOSICAO => 'Funcionários de Transposição',
        };
    }
}
