<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consulta de Questionários</title>
</head>
<body>
    <h1>Consulta simples de questionários respondidos</h1>
    <p>Usuário: {{ auth()->user()->name }}</p>

    <form method="POST" action="{{ route('logout') }}" style="margin-bottom: 16px;">
        @csrf
        <button type="submit">Sair</button>
    </form>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Questionário</th>
                <th>Público</th>
                <th>Ano</th>
                <th>Versão</th>
                <th>Ativo</th>
                <th>Respostas</th>
                <th>Última resposta</th>
            </tr>
        </thead>
        <tbody>
            @forelse($surveys as $survey)
                <tr>
                    <td>{{ $survey->name }}</td>
                    <td>{{ $survey->audience->label() }}</td>
                    <td>{{ $survey->year }}</td>
                    <td>{{ $survey->version }}</td>
                    <td>{{ $survey->is_active ? 'Sim' : 'Não' }}</td>
                    <td>{{ $survey->responses_count }}</td>
                    <td>{{ $survey->responses_max_created_at ?? 'Sem respostas' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Nenhum questionário encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
