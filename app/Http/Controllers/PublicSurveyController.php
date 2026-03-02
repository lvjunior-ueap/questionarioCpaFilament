<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Response;
use App\Models\Answer;
use Illuminate\Http\Request;

class PublicSurveyController extends Controller
{
    public function show(string $audience)
    {
        $survey = Survey::where('audience', $audience)
            ->where('year', 2026)
            ->where('is_active', true)
            ->with([
                'generalQuestions.options',
                'finalQuestions.options',
                'dimensions.questions.options'
            ])
            ->firstOrFail();

        return view('survey.show', compact('survey'));
    }

    public function submit(Request $request, string $audience)
    {
        $survey = Survey::where('audience', $audience)
            ->where('year', 2026)
            ->where('is_active', true)
            ->firstOrFail();

        $response = Response::create([
            'survey_id' => $survey->id,
        ]);

        foreach ($request->input('answers', []) as $questionId => $value) {
            Answer::create([
                'response_id' => $response->id,
                'question_id' => $questionId,
                'value' => is_array($value) ? $value : [$value],
            ]);
        }

        return redirect()->route('survey.thanks');
    }

    public function thanks()
    {
        return view('survey.thanks');
    }
}