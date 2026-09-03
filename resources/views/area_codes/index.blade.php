@extends('layouts.app')

@section('title', 'Directorio de Claves LADA de México (IFT) - Códigos de Área')
@section('meta_description', 'Guía oficial y completa de claves LADA y códigos de área de México según el IFT. Consulta de qué ciudad o estado te llaman a 10 dígitos y números reportados.')

@section('styles')
<style>
    .area-hero {
        text-align: center;
        max-width: 850px;
        margin: 1.5rem auto 2.5rem;
    }

    .area-hero h1 {
        font-size: 2.3rem;
        font-weight: 900;
        letter-spacing: -0.6px;
        color: var(--text-main);
        line-height: 1.25;
        margin-bottom: 0.75rem;
    }

    .area-hero p {
        font-size: 1.05rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* Interactive Filter Box */
    .filter-wrapper {
        max-width: 550px;
        margin: 1.5rem auto 2.5rem;
        position: relative;
    }

    .filter-input {
        width: 100%;
        padding: 0.85rem 1.25rem 0.85rem 2.75rem;
        border: 2px solid var(--primary);
        border-radius: 9999px;
        font-size: 1rem;
        font-weight: 600;
        outline: none;
        box-shadow: 0 4px 14px rgba(0, 104, 71, 0.15);
        background: white;
    }

    .filter-icon {
        position: absolute;
        left: 1.1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.1rem;
        color: var(--primary);
    }

    /* Popular Codes Grid */
    .top-codes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1rem;
        margin-bottom: 3rem;
    }

    .code-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.1rem 1.25rem;
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.15s, border-color 0.15s, box-shadow 0.15s;
        box-shadow: var(--shadow-sm);
    }

    .code-card:hover {
        transform: translateY(-2px);
        border-color: var(--primary);
        box-shadow: var(--shadow);
    }

    .code-digit-badge {
        background: rgba(0, 104, 71, 0.1);
        color: var(--primary);
        font-size: 1.35rem;
        font-weight: 900;
        min-width: 54px;
        height: 54px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid rgba(0, 104, 71, 0.2);
    }

    .code-info-text strong {
        display: block;
        font-size: 1rem;
        color: var(--text-main);
        margin-bottom: 0.15rem;
    }

    .code-info-text span {
        font-size: 0.82rem;
        color: var(--text-muted);
    }

    /* Region Sections */
    .region-block {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .region-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--border);
    }

    .sub-codes-flex {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
        gap: 0.75rem;
    }

    .sub-code-item {
        background: var(--background);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 0.65rem 0.85rem;
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        transition: all 0.15s;
    }

    .sub-code-item:hover {
        background: white;
        border-color: var(--primary);
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    .sub-code-digit {
        font-weight: 800;
        font-size: 0.9rem;
        color: var(--primary);
        font-variant-numeric: tabular-nums;
    }

    .sub-code-city {
        font-size: 0.82rem;
        color: var(--text-muted);
        text-align: right;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection

@section('content')
<div class="content-tool">
    <!-- Breadcrumb -->
    <nav style="font-size:0.85rem; color:var(--text-muted); margin-bottom:1.25rem">
        <a href="{{ route('home') }}" style="color:var(--primary); text-decoration:none; font-weight:700">Inicio</a>
        <span style="margin:0 0.4rem">›</span>
        <span>Claves LADA de México</span>
    </nav>

    <!-- Hero -->
    <div class="area-hero">
        <span style="display:inline-block; background:rgba(0, 104, 71, 0.1); color:var(--primary); font-weight:800; font-size:0.82rem; padding:4px 12px; border-radius:9999px; margin-bottom:0.75rem">
            🇲🇽 Catálogo Oficial IFT México · Plan Técnico Fundamental de Numeración
        </span>
        <h1>Directorio de Claves LADA y Códigos de Área de México</h1>
        <p>
            Guía unificada de marcación nacional a 10 dígitos según el <strong>Instituto Federal de Telecomunicaciones (IFT)</strong>. Consulta a qué estado o municipio corresponde cada clave LADA y descubre números reportados.
        </p>

        <!-- Filtro Interactivo en Tiempo Real -->
        <div class="filter-wrapper">
            <span class="filter-icon">🔍</span>
            <input type="text" id="filterInput" class="filter-input" placeholder="Filtrar por clave LADA o ciudad (ej: 55, 33, CDMX, Guadalajara, Monterrey...)" autocomplete="off">
        </div>
    </div>

    <!-- Principales Códigos de Área -->
    <h2 style="font-size:1.35rem; font-weight:800; color:var(--text-main); margin-bottom:1rem; display:flex; align-items:center; gap:0.5rem">
        <span>⭐</span> Principales Claves LADA de México
    </h2>

    <div class="top-codes-grid">
        @foreach($topCodes as $code => $info)
            <a href="{{ route('area-codes.show', $code) }}" class="code-card">
                <div class="code-digit-badge">{{ $code }}</div>
                <div class="code-info-text">
                    <strong>{{ $info['city'] }}</strong>
                    <span>{{ $info['region'] }}</span>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Directorio Completo por Región -->
    <h2 style="font-size:1.35rem; font-weight:800; color:var(--text-main); margin-bottom:1.25rem; display:flex; align-items:center; gap:0.5rem">
        <span>📍</span> Directorio de Claves LADA por Región
    </h2>

    <section id="directorySections">
        @foreach($grouped as $region => $codes)
            <div class="region-block" data-region="{{ Str::lower($region) }}">
                <div class="region-title">
                    <span>🇲🇽</span>
                    <span>{{ $region }}</span>
                    <span style="font-size:0.8rem; font-weight:600; color:var(--text-muted); margin-left:auto">
                        {{ count($codes) }} claves LADA
                    </span>
                </div>

                <div class="sub-codes-flex">
                    @foreach($codes as $c => $d)
                        <a href="{{ route('area-codes.show', $c) }}" class="sub-code-item" data-code="{{ $c }}" data-city="{{ Str::lower($d['city']) }}" data-reg="{{ Str::lower($region) }}">
                            <span class="sub-code-digit">LADA {{ $c }}</span>
                            <span class="sub-code-city" title="{{ $d['city'] }}">{{ $d['city'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>

    <!-- Guía de Marcación Oficial IFT -->
    <div class="region-block" style="background: linear-gradient(135deg, #006847, #004d34); color:white; border:none; margin-top:3rem">
        <h3 style="color:white; font-size:1.35rem; font-weight:800; margin-bottom:1rem">
            📞 ¿Cómo funciona la marcación a 10 dígitos en México (IFT)?
        </h3>
        <p style="color:#dcfce7; font-size:0.95rem; line-height:1.7; margin-bottom:1rem">
            Desde el 3 de agosto de 2019, México adoptó la <strong>marcación uniforme a 10 dígitos</strong>. Se eliminaron definitivamente todos los prefijos de larga distancia nacional y celular:
        </p>
        <ul style="color:#f0fdf4; font-size:0.9rem; line-height:1.8; margin-left:1.5rem">
            <li><strong>Ya no se marca 01</strong> para llamadas de larga distancia nacional.</li>
            <li><strong>Ya no se marca 044 ni 045</strong> para llamar a teléfonos celulares.</li>
            <li><strong>Marcación nacional:</strong> Se marcan los 10 dígitos directamente (clave LADA + número local).</li>
            <li><strong>Marcación desde el extranjero:</strong> Se marca el código internacional de México (+52) seguido de los 10 dígitos.</li>
        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('filterInput');
    const items = document.querySelectorAll('.sub-code-item');
    const blocks = document.querySelectorAll('.region-block[data-region]');

    input.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase().trim();

        items.forEach(function(item) {
            const code = item.getAttribute('data-code');
            const city = item.getAttribute('data-city');
            const reg = item.getAttribute('data-reg');

            if (code.includes(query) || city.includes(query) || reg.includes(query)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });

        // Ocultar bloques de región vacíos
        blocks.forEach(function(block) {
            const visibleItems = block.querySelectorAll('.sub-code-item[style*="display: flex"]');
            if (query === '') {
                block.style.display = 'block';
            } else {
                block.style.display = visibleItems.length > 0 ? 'block' : 'none';
            }
        });
    });
});
</script>
@endsection
