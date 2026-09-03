@extends('layouts.app')

@section('title', 'Resultados de búsqueda para "' . $q . '" - QuiénLlama México')

@section('content')
    <div style="max-width:var(--content-width); margin:0 auto; padding:1.5rem 0">
        <h1 style="font-size:1.8rem; font-weight:800; color:var(--text-main); margin-bottom:0.5rem">
            🔍 Resultados para: <span style="color:var(--primary)">"{{ $q }}"</span>
        </h1>
        <p style="color:var(--text-muted); font-size:0.95rem; margin-bottom:2rem">
            Se encontraron {{ $phones->total() }} números coincidentes en la base de datos de México.
        </p>

        @if($phones->count() > 0)
            <div style="display:flex; flex-direction:column; gap:0.75rem; margin-bottom:2rem">
                @foreach($phones as $phone)
                    @php $risk = $phone->getRiskLevel(); @endphp
                    <a href="{{ route('phone.show', $phone->number) }}" style="background:white; border:1px solid var(--border); border-radius:var(--radius); padding:1.25rem; text-decoration:none; color:inherit; display:flex; justify-content:space-between; align-items:center; transition:all 0.2s; box-shadow:var(--shadow-sm)">
                        <div>
                            <div style="font-size:1.2rem; font-weight:800; color:var(--text-main); margin-bottom:0.25rem">
                                {{ $phone->formatted() }}
                            </div>
                            <div style="font-size:0.85rem; color:var(--text-muted)">
                                📍 {{ $phone->location ?: 'México' }} · 👁️ {{ $phone->views }} consultas
                            </div>
                        </div>

                        <div style="text-align:right">
                            <span style="display:inline-block; font-size:0.78rem; font-weight:700; padding:4px 10px; border-radius:6px; background:{{ $risk['bg'] }}; color:{{ $risk['text_color'] }}">
                                {{ $risk['level'] }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div>
                {{ $phones->appends(['q' => $q])->links() }}
            </div>
        @else
            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:3rem; text-align:center">
                <div style="font-size:2.5rem; margin-bottom:1rem">🔎</div>
                <h2 style="font-size:1.3rem; font-weight:700; color:var(--text-main); margin-bottom:0.5rem">
                    No encontramos números registrados para esta consulta
                </h2>
                <p style="color:var(--text-muted); font-size:0.95rem; max-width:500px; margin:0 auto 1.5rem">
                    Recuerda que los números en México tienen 10 dígitos (ej: <code>55 1234 5678</code> para CDMX o <code>33 1234 5678</code> para Guadalajara).
                </p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    Volver al Inicio
                </a>
            </div>
        @endif
    </div>
@endsection
