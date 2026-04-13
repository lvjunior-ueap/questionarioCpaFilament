<?php

namespace Database\Seeders;

use App\Models\Survey;
use App\Models\Response;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponsesSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar surveys ativos
        $surveys = Survey::where('is_active', true)->get();

        foreach ($surveys as $survey) {
            // Para cada survey, criar 40 respostas
            for ($i = 0; $i < 40; $i++) {
                // Escolher um usuário aleatório do público correspondente
                $user = User::where('audience', $survey->audience->value)->inRandomOrder()->first();
                if (!$user) continue; // Se não houver usuário, pular

                DB::transaction(function () use ($survey, $user) {
                    $response = Response::create([
                        'survey_id' => $survey->id,
                        'respondent_hash' => hash('sha256', $user->cpf . now()->timestamp),
                    ]);

                    // Para cada pergunta do survey, criar uma resposta
                    $questions = $survey->generalQuestions->merge($survey->dimensions->flatMap->questions)->merge($survey->finalQuestions);

                    foreach ($questions as $question) {
                        $value = $this->generateAnswerValue($question, $survey);
                        Answer::create([
                            'response_id' => $response->id,
                            'question_id' => $question->id,
                            'value' => is_array($value) ? $value : [$value],
                        ]);
                    }
                });
            }
        }
    }

    private function generateAnswerValue($question, $survey)
    {
        // Para enviesar, se for survey docente, fazer respostas mais positivas
        $biased = $survey->audience->value === 'docente' ? true : false;

        switch ($question->type->value) {
            case 'radio':
            case 'likert':
                $options = $question->options;
                if ($biased && $question->text !== 'Sugestões:') {
                    // Escolher opções positivas (últimas)
                    $positiveOptions = $options->take(-2); // Últimas 2
                    return $positiveOptions->random()->value;
                }
                return $options->random()->value;

            case 'checkbox':
                $options = $question->options;
                $count = rand(1, min(3, $options->count()));
                return $options->random($count)->pluck('value')->toArray();

            case 'text':
                if ($question->text === 'Sugestões:') {
                    return ['Muito bom, continue assim!'];
                }
                return ['Resposta de exemplo gerada automaticamente.'];

            default:
                return [''];
        }
    }
}