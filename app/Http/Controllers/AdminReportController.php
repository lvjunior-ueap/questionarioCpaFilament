<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use App\Models\Answer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function index()
    {
        $surveys = Survey::query()
            ->withCount('responses')
            ->withMax('responses', 'created_at')
            ->orderBy('year', 'desc')
            ->orderBy('name')
            ->get();

        return view('admin.reports', compact('surveys'));
    }

    public function pdf($surveyId)
    {
        $survey = Survey::with(['dimensions.questions.options', 'generalQuestions.options', 'finalQuestions.options', 'responses'])->findOrFail($surveyId);

        $data = [];

        // Para cada dimensão
        foreach ($survey->dimensions as $dimension) {
            $data[$dimension->name] = [];
            foreach ($dimension->questions as $question) {
                $data[$dimension->name][$question->text] = $this->getQuestionStats($question);
            }
        }

        // Perguntas gerais
        $data['Perguntas Iniciais'] = [];
        foreach ($survey->generalQuestions as $question) {
            $data['Perguntas Iniciais'][$question->text] = $this->getQuestionStats($question);
        }

        // Considerações finais
        $data['Considerações Finais'] = [];
        foreach ($survey->finalQuestions as $question) {
            $data['Considerações Finais'][$question->text] = $this->getQuestionStats($question);
        }

        $pdf = Pdf::loadView('admin.report_pdf', compact('survey', 'data'));
        return $pdf->download('relatorio_' . $survey->name . '.pdf');
    }

    private function getQuestionStats($question)
    {
        $stats = [];

        if (in_array($question->type->value, ['radio', 'likert'])) {
            foreach ($question->options as $option) {
                $count = Answer::where('question_id', $question->id)
                    ->whereJsonContains('value', $option->value)
                    ->count();
                $stats[$option->label] = $count;
            }
        } elseif ($question->type->value === 'checkbox') {
            foreach ($question->options as $option) {
                $count = Answer::where('question_id', $question->id)
                    ->whereJsonContains('value', $option->value)
                    ->count();
                $stats[$option->label] = $count;
            }
        } elseif ($question->type->value === 'text') {
            $stats['Respostas'] = Answer::where('question_id', $question->id)->count();
        }

        return $stats;
    }
}
