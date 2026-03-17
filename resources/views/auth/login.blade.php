<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - CPA 2026</title>
</head>
<body>
    <h1>Login</h1>
    <p>Use seu CPF e senha para acessar o questionário.</p>

    @if ($errors->any())
        <div style="color: red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.attempt') }}">
        @csrf

        <label for="cpf">CPF</label><br>
        <input id="cpf" name="cpf" type="text" value="{{ old('cpf') }}" required><br><br>

        <label for="password">Senha</label><br>
        <input id="password" name="password" type="password" required><br><br>

        <label>
            <input type="checkbox" name="remember" value="1"> Manter conectado
        </label><br><br>

        <button type="submit">Entrar</button>
    </form>

    <p><a href="{{ route('landing') }}">Voltar</a></p>
</body>
</html>
