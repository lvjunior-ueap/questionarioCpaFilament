<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CPA 2026 - UEAP</title>
</head>
<body>
    <h1>Bem-vindo ao Questionário CPA 2026</h1>
    <p>Faça login com seu CPF para ser direcionado automaticamente ao questionário do seu público.</p>

    @auth
        <p>Olá, {{ auth()->user()->name }}.</p>
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.reports') }}">Ir para consultas administrativas</a>
        @else
            <a href="{{ route('survey.show', auth()->user()->audience->value) }}">Ir para meu questionário</a>
        @endif

        <form method="POST" action="{{ route('logout') }}" style="margin-top: 12px;">
            @csrf
            <button type="submit">Sair</button>
        </form>
    @else
        <a href="{{ route('login') }}">Entrar com CPF</a>
    @endauth
</body>
</html>
