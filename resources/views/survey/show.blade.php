@extends('layouts.app')

@section('title', $survey->name)

@section('content')
    <section class="card">
        <h1>{{ $survey->name }}</h1>
        <p class="muted">Usuário: {{ auth()->user()->name }}</p>
        <p style="white-space: pre-line;">{{ $survey->intro_text }}</p>

        <form method="POST" action="{{ route('logout') }}" class="actions">
            @csrf
            <button class="btn btn-outline" type="submit">Sair</button>
        </form>
    </section>

    <form method="POST" action="{{ route('survey.submit', $survey->audience->value) }}">
        @csrf

        @if($survey->generalQuestions->count())
            <section class="card">
                <h2 class="section-title">Perguntas Iniciais</h2>
                @foreach($survey->generalQuestions as $question)
                    <div class="question-card">
                        <p><strong>{{ $question->text }}</strong></p>
                        @include('survey.partials.question', ['question' => $question])
                    </div>
                @endforeach
            </section>
        @endif

        @foreach($survey->dimensions as $dimension)
            <section class="card">
                <h2 class="section-title">{{ $dimension->name }}</h2>
                @foreach($dimension->questions as $question)
                    <div class="question-card">
                        <p><strong>{{ $question->text }}</strong></p>
                        @include('survey.partials.question', ['question' => $question])
                    </div>
                @endforeach
            </section>
        @endforeach

        @if($survey->finalQuestions->count())
            <section class="card">
                <h2 class="section-title">Considerações Finais</h2>
                @foreach($survey->finalQuestions as $question)
                    <div class="question-card">
                        <p><strong>{{ $question->text }}</strong></p>
                        @include('survey.partials.question', ['question' => $question])
                    </div>
                @endforeach
            </section>
        @endif

        <section class="actions">
            <button class="btn btn-secondary" type="submit">Enviar respostas</button>
        </section>
    </form>
@endsection
