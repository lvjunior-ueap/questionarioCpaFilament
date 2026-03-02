<!DOCTYPE html>
<html>
<head>
    <title>{{ $survey->name }}</title>
    <meta charset="utf-8">
</head>
<body>

<h1>{{ $survey->name }}</h1>

<p style="white-space: pre-line;">
    {{ $survey->intro_text }}
</p>

<form method="POST" action="{{ route('survey.submit', $survey->audience->value) }}">
    @csrf

    <hr>

    <h2>Perguntas Iniciais</h2>

    @foreach($survey->questions as $question)
        <div style="margin-bottom:20px;">
            <p><strong>{{ $question->text }}</strong></p>

            @include('survey.partials.question', ['question' => $question])
        </div>
    @endforeach

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

    <button type="submit">Enviar Respostas</button>

</form>

</body>
</html>