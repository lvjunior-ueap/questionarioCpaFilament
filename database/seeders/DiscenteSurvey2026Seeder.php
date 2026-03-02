<?php

namespace Database\Seeders;

use App\Models\Survey;
use App\Models\Question;
use App\Enums\AudienceType;
use App\Enums\QuestionType;
use Illuminate\Database\Seeder;

class DiscenteSurvey2026Seeder extends Seeder
{
    public function run(): void
    {
        $survey = Survey::create([
            'name' => 'CPA Discente 2026',
            'audience' => AudienceType::DISCENTE,
            'year' => 2026,
            'version' => 1,
            'is_active' => true,
            'intro_text' => 'COLE AQUI O TEXTO INTRODUTÓRIO DO DISCENTE',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Perguntas Gerais (Discente)
        |--------------------------------------------------------------------------
        */

        // Vamos preencher assim que você enviar

        /*
        |--------------------------------------------------------------------------
        | Dimensão I
        |--------------------------------------------------------------------------
        */

        // Vamos começar pela primeira dimensão que você enviar
    }

    private function createOptions(Question $question, array $labels): void
    {
        foreach ($labels as $index => $label) {
            $question->options()->create([
                'label' => $label,
                'value' => $index + 1,
                'order' => $index + 1,
            ]);
        }
    }

    private function createLikertScale7(Question $question): void
    {
        $labels = [
            'Não sei',
            'Não se aplica',
            'Discordo totalmente',
            'Discordo parcialmente',
            'Indiferente',
            'Concordo parcialmente',
            'Concordo totalmente',
        ];

        $this->createOptions($question, $labels);
    }
}