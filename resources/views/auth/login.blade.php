@extends('layouts.app')

@section('title', 'Login - CPA 2026')

@section('content')
    <section class="card" style="max-width: 520px; margin: 0 auto;">
        <h1>Login de acesso</h1>
        <p class="muted">Informe seu CPF e senha para ser direcionado automaticamente ao questionário correspondente.</p>

        @if ($errors->any())
            <div class="alert" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}" class="grid" style="margin-top: 12px;">
            @csrf

            <label for="cpf">CPF</label>
            <input id="cpf" name="cpf" type="text" value="{{ old('cpf') }}" required>

            <label for="password">Senha</label>
            <input id="password" name="password" type="password" required>

            <label>
                <input type="checkbox" name="remember" value="1"> Manter conectado
            </label>

            <div class="actions">
                <button class="btn" type="submit">Entrar</button>
                <a class="btn btn-outline" href="{{ route('landing') }}">Voltar</a>
            </div>
        </form>
    </section>
@endsection
