@extends('layouts.app')

@section('title', 'Clave LADA ' . $clean . ' México: ¿De dónde es el código ' . $clean . '?')
@section('meta_description', '¿De qué ciudad o estado es la clave LADA ' . $clean . ' en México? Conoce la localidad correspondiente a la LADA ' . $clean . ' (' . $info['city'] . '), cómo marcar según el IFT y números denunciados.')

@section('styles')
<style>
    .area-detail-wrapper {
        max-width: var(--content-width);
        margin: 0 auto 3.5rem;
    }

    .back-nav {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--primary);
        font-weight: 700;
        text-decoration: none;
        margin-bottom: 1.25rem;
    }

    .back-nav:hover {
        text-decoration: underline;
    }

    /* Main Area Header */
    .area-main-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2.25rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
    }

    .area-badge-top {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(0, 104, 71, 0.08);
        color: var(--primary);
        font-weight: 700;
        font-size: 0.84rem;
        padding: 4px 12px;
        border-radius: 9999px;
        margin-bottom: 1rem;
    }

    .area-main-card h1 {
        font-size: 2.1rem;
        font-weight: 900;
        letter-spacing: -0.5px;
        color: var(--text-main);
        line-height: 1.25;
        margin-bottom: 0.75rem;
    }

    .area-main-card h1 span {
        color: var(--primary);
    }

    .area-main-desc {
        font-size: 1.05rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    /* Key-Value Quick Metrics */
    .area-metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
    }

    .metric-box {
        background: var(--background);
        border-radius: var(--radius);
        padding: 1rem;
        border: 1px solid var(--border);
    }

    .metric-box span {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 0.25rem;
        letter-spacing: 0.5px;
    }

    .metric-box strong {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-main);
    }

    /* Phone List Section */
    .phones-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .phones-card h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .phones-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 0.75rem;
        margin-top: 1.25rem;
    }

    .phone-item-link {
        background: var(--background);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 0.75rem 1rem;
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.15s;
    }

    .phone-item-link:hover {
        background: white;
        border-color: var(--primary);
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    .phone-item-link strong {
        color: var(--primary);
        font-size: 0.95rem;
    }

    .phone-item-link span {
        font-size: 0.78rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 9999px;
    }

    .badge-spam {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-clean {
        background: #f1f5f9;
        color: var(--text-muted);
    }

    /* Dialing Guide Card */
    .dialing-guide-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .dialing-guide-card h3 {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 1rem;
    }

    .dialing-table {
        width: 100%;
        border-collapse: collapse;
    }

    .dialing-table tr {
        border-bottom: 1px solid var(--border);
    }

    .dialing-table td {
        padding: 0.85rem 0.5rem;
        font-size: 0.92rem;
    }

    .dialing-table td:last-child {
        text-align: right;
        font-family: monospace;
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--primary);
    }

    /* Region Siblings */
    .region-siblings-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .region-siblings-card h3 {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 1rem;
    }

    .siblings-flex {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
    }

    .sibling-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--background);
        border: 1px solid var(--border);
        padding: 0.45rem 0.85rem;
        border-radius: 9999px;
        text-decoration: none;
        color: inherit;
        font-size: 0.88rem;
        font-weight: 700;
        transition: all 0.15s;
    }

    .sibling-badge:hover {
        background: white;
        border-color: var(--primary);
        color: var(--primary);
    }
</style>
@endsection

@section('content')
<div class="area-detail-wrapper">
    <!-- Breadcrumb -->
    <a href="{{ route('area-codes.index') }}" class="back-nav">
        ← Volver al catálogo de Claves LADA IFT
    </a>

    <!-- Main Card -->
    <div class="area-main-card">
        <div class="area-badge-top">
            <span>🇲🇽</span> Clave LADA Oficial IFT México
        </div>

        <h1>Clave LADA <span>{{ $clean }}</span>: {{ $info['city'] }}</h1>

        <p class="area-main-desc">
            La clave LADA <strong>{{ $clean }}</strong> está asignada por el Instituto Federal de Telecomunicaciones (IFT) a la región de <strong>{{ $info['city'] }}</strong>, en el estado de <strong>{{ $info['region'] }}</strong>. Forma parte del Plan Técnico Fundamental de Numeración con marcación uniforme a 10 dígitos.
        </p>

        <div class="area-metrics-grid">
            <div class="metric-box">
                <span>Clave LADA IFT</span>
                <strong>{{ $clean }}</strong>
            </div>
            <div class="metric-box">
                <span>Ciudad / Municipio</span>
                <strong>{{ $info['city'] }}</strong>
            </div>
            <div class="metric-box">
                <span>Estado / Región</span>
                <strong>{{ $info['region'] }}</strong>
            </div>
            <div class="metric-box">
                <span>Longitud Total</span>
                <strong>10 Dígitos</strong>
            </div>
        </div>
    </div>

    <!-- Dialing Guide -->
    <div class="dialing-guide-card">
        <h3>📞 Cómo marcar a números con LADA {{ $clean }}</h3>
        <table class="dialing-table">
            <tr>
                <td>Marcación Nacional (desde cualquier parte de México)</td>
                <td>{{ $clean }} XXXX XXXX</td>
            </tr>
            <tr>
                <td>Marcación Internacional (desde el extranjero o WhatsApp)</td>
                <td>+52 {{ $clean }} XXXX XXXX</td>
            </tr>
            <tr>
                <td>Marcación desde Estados Unidos y Canadá</td>
                <td>011 52 {{ $clean }} XXXX XXXX</td>
            </tr>
            <tr>
                <td>Tipo de Marcación Oficial</td>
                <td>Directa a 10 dígitos (Sin 01, 044 ni 045)</td>
            </tr>
        </table>
    </div>

    <!-- Phones investigated in this area code -->
    <div class="phones-card">
        <h2>
            <span>🔍</span> Números investigados con LADA {{ $clean }}
        </h2>
        <p style="color:var(--text-muted); font-size:0.9rem;">
            Teléfonos con clave LADA {{ $clean }} buscados o reportados por los usuarios en México:
        </p>

        @if($phones->isNotEmpty())
            <div class="phones-grid">
                @foreach($phones as $p)
                    <a href="{{ route('phone.show', $p->number) }}" class="phone-item-link">
                        <strong>{{ $p->formatted() }}</strong>
                        @if($p->spam_score > 0)
                            <span class="badge-spam">⚠️ SPAM</span>
                        @else
                            <span class="badge-clean">Ver ficha</span>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <div style="background:var(--background); border-radius:var(--radius); padding:1.5rem; text-align:center; margin-top:1rem;">
                <p style="color:var(--text-muted); margin:0; font-size:0.92rem;">
                    Aún no hay números con clave LADA <strong>{{ $clean }}</strong> reportados. Si recibiste una llamada sospechosa, puedes buscarla directamente en la barra superior.
                </p>
            </div>
        @endif
    </div>

    <!-- Sibling Area Codes in same Region -->
    @if(!empty($regionCodes))
    <div class="region-siblings-card">
        <h3>📍 Otras claves LADA en {{ $info['region'] }}</h3>
        <div class="siblings-flex">
            @foreach($regionCodes as $s)
                <a href="{{ route('area-codes.show', $s['code']) }}" class="sibling-badge">
                    <span>LADA {{ $s['code'] }}</span>
                    <span style="color:var(--text-muted); font-weight:normal">({{ $s['city'] }})</span>
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
