@extends('layouts.app')

@section('title', 'CPA 2026 - UEAP')

@section('content')
    <div class="landing-hero">
        <div class="landing-bg-slide slide-1"></div>
        <div class="landing-bg-slide slide-2"></div>
        <div class="landing-overlay"></div>

        <div class="landing-content">
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
        </div>
    </div>

    <style>
        .landing-hero {
            position: relative;
            overflow: hidden;
            padding: 40px 0;
        }

        .landing-bg-slide,
        .landing-overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .landing-bg-slide {
            background-size: cover;
            background-position: center;
            opacity: 0;
            animation: landingSlideFade 20s infinite ease-in-out;
            filter: brightness(0.78) saturate(0.95);
        }

        .landing-bg-slide.slide-1 {
            background-image: url('/images/landing-bg-1.jpg');
        }

        .landing-bg-slide.slide-2 {
            background-image: url('/images/landing-bg-2.jpg');
            animation-delay: 10s;
        }

        .landing-overlay {
            background: rgba(15, 25, 42, 0.28);
            mix-blend-mode: multiply;
        }

        .landing-content {
            position: relative;
            z-index: 1;
        }

        @keyframes landingSlideFade {
            0%, 40%, 100% { opacity: 0.32; }
            45%, 95% { opacity: 0; }
        }

        .landing-hero .card {
            background: rgba(255, 255, 255, 0.92);
            border-color: rgba(215, 225, 236, 0.8);
        }
    </style>
@endsection
