<?php

namespace Database\Seeders;

use App\Models\Survey;
use App\Models\Question;
use App\Enums\AudienceType;
use App\Enums\QuestionType;
use Illuminate\Database\Seeder;

class TecnicoSurvey2026Seeder extends Seeder
{
    public function run(): void
    {
        $survey = Survey::create([
            'name' => 'CPA Técnico 2026',
            'audience' => AudienceType::TECNICO,
            'year' => 2026,
            'version' => 1,
            'is_active' => true,
            'intro_text' => <<<TEXT
            Prezado(a) Técnico(a),

            Este questionário integra parte do processo de avaliação institucional da Universidade do Estado do Amapá (UEAP). Trata-se de um instrumento de autoavaliação exigido pelo Sistema Nacional de Avaliação da Educação Superior (Sinaes), do Ministério da Educação, que visa produzir conhecimentos que colaborem para o aperfeiçoamento da instituição. A autoavaliação da UEAP é coordenada pela Comissão Própria de Avaliação (CPA) e refere-se ao ano de 2025. Sua participação será breve, anônima e de extrema relevância. Tente responder de modo mais sincero e exato possível.
            TEXT,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Perguntas Gerais
        |--------------------------------------------------------------------------
        */

        $vinculo = $survey->questions()->create([
            'survey_id' => $survey->id,
            'dimension_id' => null,
            'text' => 'Atualmente tem um vínculo com a UEAP?',
            'type' => QuestionType::RADIO,
            'required' => true,
            'order' => 1,
        ]);

        $this->createOptions($vinculo, [
            'Não',
            'Sim',
        ]);

        $campus = $survey->questions()->create([
            'survey_id' => $survey->id,
            'dimension_id' => null,
            'text' => 'Campus que frequenta',
            'type' => QuestionType::RADIO,
            'required' => true,
            'order' => 2,
        ]);

        $this->createOptions($campus, [
            'Macapá',
            'Território dos Lagos (CTL) - Amapá',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Dimensão I
        |--------------------------------------------------------------------------
        */

        // Começaremos quando você enviar
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

    private function createLikertScale6SemNSA(Question $question): void
    {
        $labels = [
            'Não sei',
            'Discordo totalmente',
            'Discordo parcialmente',
            'Indiferente',
            'Concordo parcialmente',
            'Concordo totalmente',
        ];

        $this->createOptions($question, $labels);
    }
}