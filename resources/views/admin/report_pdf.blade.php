<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório - {{ $survey->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1, h2 { color: #003e7e; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Relatório de Avaliação: {{ $survey->name }}</h1>
    <p><strong>Total de Respostas:</strong> {{ $survey->responses->count() }}</p>

    @foreach($data as $section => $questions)
        <h2>{{ $section }}</h2>
        @foreach($questions as $questionText => $stats)
            <h3>{{ $questionText }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>Opção</th>
                        <th>Contagem</th>
                        <th>Percentual</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = array_sum($stats); @endphp
                    @foreach($stats as $option => $count)
                        <tr>
                            <td>{{ $option }}</td>
                            <td>{{ $count }}</td>
                            <td>{{ $total > 0 ? round(($count / $total) * 100, 1) : 0 }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endforeach
</body>
</html>