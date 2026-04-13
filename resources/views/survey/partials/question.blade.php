@php
    $name = "answers[{$question->id}]";
@endphp

@if($question->type->value === 'radio')
    <fieldset>
        <legend class="sr-only">{{ $question->text }}</legend>
        @foreach($question->options as $option)
            <label>
                <input type="radio" name="{{ $name }}" value="{{ $option->value }}" required="{{ $question->required ? 'required' : '' }}">
                {{ $option->label }}
            </label><br>
        @endforeach
    </fieldset>

@elseif($question->type->value === 'checkbox')
    <fieldset>
        <legend class="sr-only">{{ $question->text }}</legend>
        @foreach($question->options as $option)
            <label>
                <input type="checkbox" name="{{ $name }}[]" value="{{ $option->value }}">
                {{ $option->label }}
            </label><br>
        @endforeach
    </fieldset>

@elseif($question->type->value === 'likert')
    <fieldset>
        <legend class="sr-only">{{ $question->text }}</legend>
        @foreach($question->options as $option)
            <label style="margin-right:10px;">
                <input type="radio" name="{{ $name }}" value="{{ $option->value }}" required="{{ $question->required ? 'required' : '' }}">
                {{ $option->label }}
            </label>
        @endforeach
    </fieldset>

@elseif($question->type->value === 'text')
    <label for="answer-{{ $question->id }}">{{ $question->text }}</label>
    <textarea id="answer-{{ $question->id }}" name="{{ $name }}" rows="4" cols="60" required="{{ $question->required ? 'required' : '' }}"></textarea>
@endif

