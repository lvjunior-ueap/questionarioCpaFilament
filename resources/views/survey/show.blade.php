@extends('layouts.app')

@section('title', $survey->name)

@section('content')
    <section class="card">
        <h1>{{ $survey->name }}</h1>
        <p class="muted">Usuário: {{ auth()->user()->name }}</p>
        <p style="white-space: pre-line;">{{ $survey->intro_text }}</p>

        <div class="progress-container">
            <div class="progress-bar">
                <div class="progress-fill" id="progress-fill"></div>
            </div>
            <p class="progress-text">Progresso: <span id="progress-text">0 de {{ $totalQuestions }}</span></p>
        </div>

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
            <button class="btn btn-secondary" type="submit" id="submit-btn">Enviar respostas</button>
        </section>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const total = {{ $totalQuestions }};
            const progressFill = document.getElementById('progress-fill');
            const progressText = document.getElementById('progress-text');

            function updateProgress() {
                let answered = 0;

                // Radios: count unique groups with selection
                const radioGroups = {};
                document.querySelectorAll('input[type="radio"]').forEach(r => {
                    if (!radioGroups[r.name]) radioGroups[r.name] = false;
                    if (r.checked) radioGroups[r.name] = true;
                });
                answered += Object.values(radioGroups).filter(v => v).length;

                // Checkboxes: count unique groups with at least one checked
                const checkboxGroups = {};
                document.querySelectorAll('input[type="checkbox"]').forEach(c => {
                    if (!checkboxGroups[c.name]) checkboxGroups[c.name] = false;
                    if (c.checked) checkboxGroups[c.name] = true;
                });
                answered += Object.values(checkboxGroups).filter(v => v).length;

                // Textareas: count if has value
                document.querySelectorAll('textarea').forEach(t => {
                    if (t.value.trim()) answered++;
                });

                const percent = (answered / total) * 100;
                progressFill.style.width = percent + '%';
                progressText.textContent = answered + ' de ' + total;
            }

            document.querySelectorAll('input[type="radio"], input[type="checkbox"], textarea').forEach(input => {
                input.addEventListener('change', updateProgress);
                if (input.type === 'textarea') input.addEventListener('input', updateProgress);
            });
        });
    </script>
@endsection
