<!DOCTYPE html>
<html>
<head>
    <title>{{ $survey->name }}</title>
    <meta charset="utf-8">
</head>
<body>

<h1>{{ $survey->name }}</h1>

<p>Usuário: {{ auth()->user()->name }}</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Sair</button>
</form>

<p style="white-space: pre-line;">
    {{ $survey->intro_text }}
</p>

<form method="POST" action="{{ route('survey.submit', $survey->audience->value) }}">
    @csrf

    {{-- ===================== --}}
    {{-- PERGUNTAS INICIAIS --}}
    {{-- ===================== --}}

    @if($survey->generalQuestions->count())
        <hr>
        <h2>Perguntas Iniciais</h2>

        @foreach($survey->generalQuestions as $question)
            <div style="margin-bottom:20px;">
                <p><strong>{{ $question->text }}</strong></p>

                @include('survey.partials.question', ['question' => $question])
            </div>
        @endforeach
    @endif


    {{-- ===================== --}}
    {{-- DIMENSÕES --}}
    {{-- ===================== --}}

    @foreach($survey->dimensions as $dimension)

        <hr>
        <h2>{{ $dimension->name }}</h2>

        @foreach($dimension->questions as $question)
            <div style="margin-bottom:20px;">
                <p><strong>{{ $question->text }}</strong></p>

                @include('survey.partials.question', ['question' => $question])
            </div>
        @endforeach

    @endforeach


    {{-- ===================== --}}
    {{-- SUGESTÕES (FINAL) --}}
    {{-- ===================== --}}

    @if($survey->finalQuestions->count())
        <hr>
        <h2>Considerações Finais</h2>

        @foreach($survey->finalQuestions as $question)
            <div style="margin-bottom:20px;">
                <p><strong>{{ $question->text }}</strong></p>

                @include('survey.partials.question', ['question' => $question])
            </div>
        @endforeach
    @endif


    <hr>
    <button type="submit">Enviar Respostas</button>

</form>

</body>
</html>