<x-filament-panels::page>
    <div class="space-y-6">
        <x-filament-panels::header>
            <h1 class="text-2xl font-bold">Relatórios de Questionários</h1>
        </x-filament-panels::header>

        <div class="bg-white rounded-lg shadow p-6">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">Questionário</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Público</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Ano</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Versão</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Ativo</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Respostas</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Última resposta</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surveys as $survey)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $survey->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $survey->audience->label() }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $survey->year }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $survey->version }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $survey->is_active ? 'Sim' : 'Não' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $survey->responses_count }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $survey->responses_max_created_at ? \Carbon\Carbon::parse($survey->responses_max_created_at)->format('d/m/Y H:i') : 'Sem respostas' }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if($survey->responses_count > 0)
                                    <a href="{{ route('admin.reports.pdf', $survey) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150" target="_blank">Gerar PDF</a>
                                @else
                                    Sem respostas
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="border border-gray-300 px-4 py-2 text-center">Nenhum questionário encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-filament-panels::page>