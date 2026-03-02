@php
    $name = "answers[{$question->id}]";
@endphp

@if($question->type->value === 'radio')
    @foreach($question->options as $option)
        <label>
            <input type="radio" name="{{ $name }}" value="{{ $option->value }}">
            {{ $option->label }}
        </label><br>
    @endforeach

@elseif($question->type->value === 'checkbox')
    @foreach($question->options as $option)
        <label>
            <input type="checkbox" name="{{ $name }}[]" value="{{ $option->value }}">
            {{ $option->label }}
        </label><br>
    @endforeach

@elseif($question->type->value === 'likert')
    @foreach($question->options as $option)
        <label style="margin-right:10px;">
            <input type="radio" name="{{ $name }}" value="{{ $option->value }}">
            {{ $option->label }}
        </label>
    @endforeach

@elseif($question->type->value === 'text')
    <textarea name="{{ $name }}" rows="4" cols="60"></textarea>
@endif

@endif

