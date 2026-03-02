<?php

namespace App\Enums;

enum QuestionType: string
{
    case LIKERT = 'likert';
    case RADIO = 'radio';
    case CHECKBOX = 'checkbox';
    case TEXT = 'text';

    public function label(): string
    {
        return match ($this) {
            self::LIKERT => 'Escala Likert',
            self::RADIO => 'Múltipla escolha (1 opção)',
            self::CHECKBOX => 'Múltipla escolha (várias opções)',
            self::TEXT => 'Resposta aberta',
        };
    }
}