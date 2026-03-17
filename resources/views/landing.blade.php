@extends('layouts.app')

@section('title', 'CPA 2026 - UEAP')

@section('content')
    <section class="card">
        <h1>Bem-vindo(a) ao Questionário Institucional da CPA</h1>
        <p class="muted">Sua participação fortalece a qualidade acadêmica e administrativa da UEAP. O acesso é simples, seguro e direcionado ao seu público.</p>
        <div class="actions">
            @auth
                @if(auth()->user()->is_admin)
                    <a class="btn" href="{{ route('admin.reports') }}">Acessar consultas administrativas</a>
                @else
                    <a class="btn" href="{{ route('survey.show', auth()->user()->audience->value) }}">Ir para meu questionário</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline" type="submit">Sair</button>
                </form>
            @else
                <a class="btn" href="{{ route('login') }}">Entrar com CPF</a>
            @endauth
        </div>
    </section>

    <section class="grid grid-2">
        <article class="card">
            <h3>Foco institucional</h3>
            <p class="muted">Questionários estruturados nas dimensões do SINAES para diagnóstico institucional e melhoria contínua.</p>
        </article>
        <article class="card">
            <h3>Ambiente acolhedor</h3>
            <p class="muted">Interface clara, legível e amigável para responder com tranquilidade.</p>
        </article>
    </section>
@endsection
