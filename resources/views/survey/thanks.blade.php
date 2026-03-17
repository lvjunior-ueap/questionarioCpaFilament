@extends('layouts.app')

@section('title', 'Obrigado pela participação')

@section('content')
    <section class="card" style="text-align:center; max-width:680px; margin:0 auto;">
        <h1>Obrigado pela participação!</h1>
        <p class="muted">Sua resposta foi registrada com sucesso e será muito importante para o aprimoramento institucional da UEAP.</p>
        <a class="btn" href="{{ route('landing') }}">Voltar ao início</a>
    </section>
@endsection
