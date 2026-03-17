@extends('layouts.app')

@section('title', 'Consulta de Questionários')

@section('content')
    <section class="card">
        <h1>Consulta simples de questionários respondidos</h1>
        <p class="muted">Administrador: {{ auth()->user()->name }}</p>

        <form method="POST" action="{{ route('logout') }}" class="actions">
            @csrf
            <button class="btn btn-outline" type="submit">Sair</button>
        </form>
    </section>

    <section class="card">
        <table class="table">
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
    </section>
@endsection
