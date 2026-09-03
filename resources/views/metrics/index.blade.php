@extends('layouts.app')

@section('title', 'Panel de Métricas Interno - QuiénLlama México')

@section('content')
<div class="content-tool">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem">
        <div>
            <h1 style="font-size:2rem; font-weight:900; color:var(--dark)">📊 Panel de Métricas y Telemetría</h1>
            <p style="color:var(--text-muted); font-size:0.95rem">Monitoreo interno en tiempo real de QuiénLlama México.</p>
        </div>
        <span style="background:#fee2e2; color:#991b1b; font-weight:800; font-size:0.8rem; padding:4px 10px; border-radius:8px">
            🔒 Área Restringida
        </span>
    </div>

    <!-- Stats Grid -->
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:2.5rem">
        <div style="background:white; border:1px solid var(--border); border-radius:var(--radius); padding:1.5rem; text-align:center">
            <div style="font-size:2rem; font-weight:900; color:var(--primary)">{{ number_format($totalPhones) }}</div>
            <div style="font-size:0.85rem; color:var(--text-muted); font-weight:600">Total Teléfonos en DB</div>
        </div>

        <div style="background:white; border:1px solid var(--border); border-radius:var(--radius); padding:1.5rem; text-align:center">
            <div style="font-size:2rem; font-weight:900; color:var(--success)">{{ number_format($totalComments) }}</div>
            <div style="font-size:0.85rem; color:var(--text-muted); font-weight:600">Total Denuncias / Reportes</div>
        </div>

        <div style="background:white; border:1px solid var(--border); border-radius:var(--radius); padding:1.5rem; text-align:center">
            <div style="font-size:2rem; font-weight:900; color:var(--warning)">{{ number_format($totalSearches) }}</div>
            <div style="font-size:0.85rem; color:var(--text-muted); font-weight:600">Búsquedas Realizadas</div>
        </div>

        <div style="background:white; border:1px solid var(--border); border-radius:var(--radius); padding:1.5rem; text-align:center">
            <div style="font-size:2rem; font-weight:900; color:var(--dark)">{{ number_format($newDiscoveredPhones) }}</div>
            <div style="font-size:0.85rem; color:var(--text-muted); font-weight:600">Números Auto-descubiertos</div>
        </div>
    </div>

    <!-- Events & Searches Breakdown -->
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:2rem; margin-bottom:3rem">
        <!-- Top Searches -->
        <div style="background:white; border:1px solid var(--border); border-radius:var(--radius); padding:1.75rem">
            <h3 style="font-size:1.15rem; font-weight:800; color:var(--dark); margin-bottom:1rem">
                🔥 Números Más Buscados
            </h3>
            <table style="width:100%; border-collapse:collapse; font-size:0.9rem">
                <thead>
                    <tr style="border-bottom:2px solid var(--border); text-align:left">
                        <th style="padding:6px 0">Número</th>
                        <th style="padding:6px 0; text-align:right">Consultas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topSearches as $s)
                        <tr style="border-bottom:1px solid var(--border)">
                            <td style="padding:8px 0">
                                <a href="{{ route('phone.show', $s->number) }}" style="color:var(--primary); font-weight:700; text-decoration:none">
                                    {{ $s->number }}
                                </a>
                            </td>
                            <td style="padding:8px 0; text-align:right; font-weight:700">
                                {{ $s->total }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" style="padding:1rem 0; color:var(--text-muted)">Sin búsquedas aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Telemetry Events -->
        <div style="background:white; border:1px solid var(--border); border-radius:var(--radius); padding:1.75rem">
            <h3 style="font-size:1.15rem; font-weight:800; color:var(--dark); margin-bottom:1rem">
                📈 Eventos de Telemetría
            </h3>
            <table style="width:100%; border-collapse:collapse; font-size:0.9rem">
                <thead>
                    <tr style="border-bottom:2px solid var(--border); text-align:left">
                        <th style="padding:6px 0">Tipo de Evento</th>
                        <th style="padding:6px 0; text-align:right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($eventsSummary as $ev)
                        <tr style="border-bottom:1px solid var(--border)">
                            <td style="padding:8px 0; font-family:monospace">
                                {{ $ev->event_type }}
                            </td>
                            <td style="padding:8px 0; text-align:right; font-weight:700">
                                {{ $ev->count }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" style="padding:1rem 0; color:var(--text-muted)">Sin eventos registrados aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
