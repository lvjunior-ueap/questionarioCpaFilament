<?php

namespace App\Enums;

enum AudienceType: string
{
    case DISCENTE = 'discente';
    case DOCENTE = 'docente';
    case TECNICO = 'tecnico';
    case GESTOR = 'gestor';

    public function label(): string
    {
        return match ($this) {
            self::DISCENTE => 'Discente',
            self::DOCENTE => 'Docente',
            self::TECNICO => 'Técnico Administrativo',
            self::GESTOR => 'Gestão',
        };
    }
}