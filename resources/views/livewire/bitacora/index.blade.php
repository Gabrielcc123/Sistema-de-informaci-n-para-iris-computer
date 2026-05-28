<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Bitacora;

// Le decimos que se integre en tu menú lateral
new #[Layout('components.layouts.app')] class extends Component {
    use WithPagination;

    public function with(): array
    {
        return [
            // Traemos los registros, ordenados por los más recientes y paginados de 10 en 10
            'registros' => Bitacora::with('usuario')
                            ->orderBy('fecha', 'desc')
                            ->orderBy('hora', 'desc')
                            ->paginate(10),
        ];
    }
}; ?>

<div class="p-6 max-w-7xl mx-auto space-y-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-100">Bitácora de Seguridad</h1>
            <p class="text-sm text-gray-400 mt-1">Auditoría histórica de accesos y movimientos en el sistema.</p>
        </div>
    </div>

    <div class="bg-[#161618] border border-gray-800 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-[#202022] text-gray-400 text-xs uppercase font-semibold border-b border-gray-800">
                    <tr>
                        <th class="px-6 py-4">Usuario</th>
                        <th class="px-6 py-4">Acción</th>
                        <th class="px-6 py-4">Dirección IP</th>
                        <th class="px-6 py-4">Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800 text-gray-300">
                    @forelse ($registros as $registro)
                        <tr class="hover:bg-[#202022]/80 transition-colors">
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-cyan-900/40 text-cyan-400 flex items-center justify-center font-bold text-xs border border-cyan-800/50 shadow-[0_0_10px_rgba(34,211,238,0.1)]">
                                        {{ substr($registro->usuario->nombre ?? 'S', 0, 1) }}{{ substr($registro->usuario->apellido ?? 'I', 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-200">{{ $registro->usuario->nombre ?? 'Sistema' }} {{ $registro->usuario->apellido ?? '' }}</div>
                                        <div class="text-xs text-gray-500">{{ $registro->usuario->email ?? 'No registrado' }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $accion = strtolower($registro->accion);
                                    if (str_contains($accion, 'exitoso')) {
                                        $color = 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20';
                                    } elseif (str_contains($accion, 'fallido')) {
                                        $color = 'bg-red-500/10 text-red-400 border-red-500/20';
                                    } elseif (str_contains($accion, 'logout')) {
                                        $color = 'bg-gray-500/10 text-gray-400 border-gray-500/20';
                                    } elseif (str_contains($accion, 'bloqueo')) {
                                        $color = 'bg-orange-500/10 text-orange-400 border-orange-500/20';
                                    } else {
                                        $color = 'bg-blue-500/10 text-blue-400 border-blue-500/20';
                                    }
                                @endphp
                                <span class="px-3 py-1 text-[11px] font-semibold rounded-full border {{ $color }}">
                                    {{ $registro->accion }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-gray-400">
                                {{ $registro->ip }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ \Carbon\Carbon::parse($registro->fecha)->format('d / m / Y') }}</div>
                                <div class="text-xs text-gray-500 mt-0.5">{{ $registro->hora }}</div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="h-10 w-10 text-gray-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    No hay registros de seguridad disponibles.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($registros->hasPages())
            <div class="px-6 py-4 border-t border-gray-800 bg-[#161618]">
                {{ $registros->links(data: ['scrollTo' => false]) }}
            </div>
        @endif
    </div>
</div>