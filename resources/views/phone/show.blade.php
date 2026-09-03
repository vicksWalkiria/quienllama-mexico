@extends('layouts.app')

@section('title', '¿De quién es el ' . $formatted . '? Quién me llama y denuncias | QuiénLlama México')
@section('meta_description', '¿De quién es el teléfono ' . $formatted . ' (' . ($phone->location ?: 'México') . ')? Descubre quién te llama en México, si es banco, cobranza, spam o extorsión, opiniones y cómo bloquearlo.')

@section('styles')
<style>
    .phone-detail {
        max-width: var(--content-width);
        margin: 0 auto;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 1.25rem;
        color: var(--primary);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    /* Phone Header (Estilo QuiénLlama) */
    .phone-header {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
    }

    .phone-header h1 {
        font-size: 2.2rem;
        font-weight: 900;
        letter-spacing: -0.5px;
        color: var(--text-main);
        margin-bottom: 1rem;
    }

    .phone-header h1 span {
        color: var(--primary);
    }

    .spam-meter-pills {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 1.25rem;
    }

    .meter-pill {
        background: var(--background);
        border: 1px solid var(--border);
        padding: 6px 14px;
        border-radius: 9999px;
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--text-main);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .meter-pill.danger {
        background: #fee2e2;
        border-color: #fca5a5;
        color: #b91c1c;
    }

    .action-btn-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        margin-top: 1rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border);
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 9999px;
        font-size: 0.88rem;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }

    .btn-copy {
        background: #e2e8f0;
        color: var(--text-main);
    }
    .btn-copy:hover {
        background: #cbd5e1;
    }

    .btn-vcf {
        background: #dc2626;
        color: white;
    }
    .btn-vcf:hover {
        background: #b91c1c;
    }

    .btn-nollame {
        background: var(--primary);
        color: white;
    }
    .btn-nollame:hover {
        background: var(--primary-hover);
    }

    .btn-wa {
        background: #25d366;
        color: white;
    }
    .btn-wa:hover {
        background: #1eb954;
    }

    /* Content Cards */
    .card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.75rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
    }

    @media (max-width: 640px) {
        .phone-header {
            padding: 1.25rem 1rem;
            text-align: center;
        }
        .phone-header h1 {
            font-size: 1.6rem;
            line-height: 1.25;
            word-break: break-word;
        }
        .spam-meter-pills {
            justify-content: center;
            gap: 6px;
        }
        .meter-pill {
            font-size: 0.8rem;
            padding: 4px 10px;
        }
        .action-btn-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
        .action-btn-row .btn-action {
            width: 100%;
            justify-content: center;
            text-align: center;
            font-size: 0.82rem;
            padding: 8px 6px;
            white-space: nowrap;
        }
        .card {
            padding: 1.25rem 1rem;
        }
        .card-title {
            font-size: 1.15rem;
        }
        .vote-options {
            grid-template-columns: 1fr 1fr;
            gap: 6px;
        }
        .dial-table td {
            font-size: 0.82rem;
            padding: 0.6rem 0.25rem;
        }
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Voting options */
    .vote-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 0.65rem;
        margin-top: 1rem;
    }

    .vote-btn {
        background: var(--background);
        border: 1.5px solid var(--border);
        padding: 0.75rem 0.5rem;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        color: var(--text-main);
        transition: all 0.2s;
        text-align: center;
    }

    .vote-btn:hover {
        background: #fee2e2;
        border-color: var(--primary);
        color: var(--primary);
    }

    /* Dialing table */
    .dial-table {
        width: 100%;
        border-collapse: collapse;
    }

    .dial-table tr {
        border-bottom: 1px solid var(--border);
    }

    .dial-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.92rem;
    }

    .dial-table td:last-child {
        text-align: right;
        font-family: monospace;
        font-size: 1rem;
        font-weight: 800;
        color: var(--text-main);
    }

    /* Forms */
    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--text-main);
        margin-bottom: 0.4rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        font-size: 0.95rem;
        background: var(--background);
        outline: none;
        transition: border 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        background: white;
        border-color: var(--primary);
    }
</style>
@endsection

@section('content')
<div class="phone-detail">
    <a href="{{ route('home') }}" class="back-link">&larr; Volver al buscador</a>

    <!-- Phone Header (Estilo QuiénLlama) -->
    <div class="phone-header">
        <h1>¿De quién es el <span>{{ $formatted }}</span>?</h1>

        <div class="spam-meter-pills">
            <span class="meter-pill {{ ($phone->spam_score > 0 || $comments->total() > 0) ? 'danger' : '' }}">
                🚨 <strong id="spamScoreVal">{{ $phone->spam_score > 0 ? $phone->spam_score : $comments->total() }}</strong> reportes comunitarios
            </span>

            <a href="{{ route('area-codes.show', $phone->area_code ?: '55') }}" class="meter-pill" style="text-decoration:none">
                📍 {{ $phone->location ?: 'México' }} (LADA {{ $phone->area_code }})
            </a>

            <span class="meter-pill">
                📞 {{ str_starts_with($phone->number, '800') ? 'Línea Sin Costo (800)' : 'Red Nacional IFT (10 dígitos)' }}
            </span>

            <span class="meter-pill">
                👁️ {{ $phone->views }} consultas
            </span>
        </div>

        <!-- Botones de Acción Rápida -->
        <div class="action-btn-row">
            <button type="button" class="btn-action btn-copy" onclick="copyNumber('{{ $phone->number }}')">
                📋 Copiar Número
            </button>

            <a href="{{ route('phone.vcf', $phone->number) }}" class="btn-action btn-vcf">
                🚫 Descargar VCF para Bloquear
            </a>

            <a href="{{ route('legal.no-molestar') }}" class="btn-action btn-nollame">
                ⚖️ REPEP PROFECO / REUS
            </a>

            <a href="https://api.whatsapp.com/send?text=Ojo%20con%20el%20tel%C3%A9fono%20{{ urlencode($formatted) }}%20({{ urlencode($phone->location ?: 'M%C3%A9xico') }}).%20Revisa%20los%20reportes:%20{{ urlencode(url()->current()) }}" target="_blank" rel="noopener" class="btn-action btn-wa">
                💬 Compartir en WhatsApp
            </a>
        </div>
    </div>

    <!-- Quick Poll Voting Card -->
    <div class="card" style="border: 2px solid var(--primary); background:#ffffff;">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:0.5rem">
            <span style="font-size:1.4rem">🗳️</span>
            <h2 style="font-size:1.15rem; font-weight:800; color:var(--text-main); margin:0">
                ¿Te llamaron desde este número? Vota en 1 clic:
            </h2>
        </div>
        <p style="font-size:0.88rem; color:var(--text-muted); margin-bottom:0.75rem">
            Tu voto ayuda al instante a categorizar si este número es spam, despacho de cobranza o una posible extorsión en México.
        </p>

        <form action="{{ route('phone.vote', $phone->number) }}" method="POST">
            @csrf
            <div class="vote-options">
                <button type="submit" name="reason" value="Extorsión / Secuestro Virtual" class="vote-btn">🚨 Falsa Extorsión</button>
                <button type="submit" name="reason" value="Fraude Bancario / Phishing" class="vote-btn">🏦 Fraude Bancario</button>
                <button type="submit" name="reason" value="Cobranza Abusiva" class="vote-btn">💳 Cobranza / Despacho</button>
                <button type="submit" name="reason" value="Telemarketing / Ventas" class="vote-btn">📢 Telemarketing</button>
                <button type="submit" name="reason" value="Llamada Fantasma / Silenciosa" class="vote-btn">🔇 Llamada Fantasma</button>
            </div>
        </form>
    </div>

    <!-- Comments / Reports Section -->
    <div class="card">
        <h2 class="card-title">💬 Denuncias y Comentarios de Usuarios ({{ $comments->total() }})</h2>

        @forelse($comments as $comment)
            <div style="border-bottom:1px solid var(--border); padding:1rem 0">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.4rem">
                    <strong style="color:var(--text-main); font-size:0.95rem">👤 {{ $comment->author_name }}</strong>
                    <span style="background:#fee2e2; color:var(--primary); font-size:0.75rem; font-weight:700; padding:2px 8px; border-radius:6px">
                        {{ $comment->reason }}
                    </span>
                </div>
                <p style="font-size:0.92rem; color:#334155; line-height:1.6; margin-bottom:0.4rem">
                    {{ $comment->content }}
                </p>
                <span style="font-size:0.78rem; color:var(--text-muted)">
                    📅 {{ $comment->created_at->translatedFormat('d \d\e F \d\e Y, H:i') }}
                </span>
            </div>
        @empty
            <p style="color:var(--text-muted); padding:0.5rem 0">
                Todavía no hay comentarios para este número. Sé el primero en compartir tu experiencia abajo para advertir a la comunidad.
            </p>
        @endforelse

        <div style="margin-top:1.25rem">
            {{ $comments->links() }}
        </div>
    </div>

    <!-- Formulario de denuncia -->
    <div class="card" id="formulario-reporte">
        <h2 class="card-title">📝 Dejar un Reporte sobre el {{ $formatted }}</h2>
        <p style="font-size:0.88rem; color:var(--text-muted); margin-bottom:1.25rem">
            ¿Qué te dijeron cuando contestaste? ¿De qué banco, empresa o despacho decían ser? Tu reporte protege a millones de personas en México.
        </p>

        <form action="{{ route('phone.comment', $phone->number) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="author_name">Tu Nombre o Alias (Opcional):</label>
                <input type="text" id="author_name" name="author_name" placeholder="Ej: Usuario de CDMX, Vecino de Guadalajara, Anónimo...">
            </div>

            <div class="form-group">
                <label for="reason">Motivo del Reporte (*):</label>
                <select id="reason" name="reason" required>
                    <option value="Extorsión / Secuestro Virtual">🚨 Extorsión Telefónica / Amenaza / Secuestro Virtual</option>
                    <option value="Fraude Bancario / Phishing">🏦 Fraude Bancario / Robo de Datos / Falso Cargo</option>
                    <option value="Cobranza Abusiva">💳 Cobranza Abusiva / Despacho Jurídico</option>
                    <option value="Telemarketing / Ventas">📢 Telemarketing / Promoción de Tarjetas, Seguros o Telefonía</option>
                    <option value="Llamada Fantasma / Silenciosa">🔇 Llamada Fantasma / Silenciosa (Cuelgan al contestar)</option>
                    <option value="Otro">ℹ️ Otro Motivo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="content">Detalle de la llamada (*):</label>
                <textarea id="content" name="content" rows="4" required minlength="6" placeholder="Cuenta qué te dijeron cuando te marcaron..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%">
                📢 Publicar Reporte Ciudadano
            </button>
        </form>
    </div>

    <!-- Formas de marcación -->
    <div class="card">
        <h3 class="card-title">📞 Formas de Marcación Oficiales (IFT México)</h3>
        <table class="dial-table">
            <tr>
                <td>Marcación Nacional Directa (Fijo o Móvil)</td>
                <td>{{ $formatted }} (10 dígitos)</td>
            </tr>
            <tr>
                <td>Marcación Internacional / WhatsApp</td>
                <td>+52 {{ $phone->number }}</td>
            </tr>
            <tr>
                <td>Marcación desde Estados Unidos y Canadá</td>
                <td>011 52 {{ $phone->number }}</td>
            </tr>
            <tr>
                <td>Ubicación / Cobertura IFT</td>
                <td>{{ $phone->location ?: 'México' }}</td>
            </tr>
        </table>
    </div>

    <!-- FAQs Schema.org FAQPage -->
    <div class="card">
        <h3 class="card-title">❓ Preguntas Frecuentes</h3>
        
        <div style="margin-bottom:1.25rem">
            <h4 style="font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:0.25rem">
                ¿De qué ciudad o estado es el número {{ $formatted }}?
            </h4>
            <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6">
                Corresponde a una línea asignada bajo la clave LADA <strong>{{ $phone->area_code }}</strong> de <strong>{{ $phone->location ?: 'México' }}</strong> según el Plan Técnico Fundamental del IFT.
            </p>
        </div>

        <div>
            <h4 style="font-size:1rem; font-weight:700; color:var(--text-main); margin-bottom:0.25rem">
                ¿Cómo puedo bloquear este número en mi celular?
            </h4>
            <p style="font-size:0.9rem; color:var(--text-muted); line-height:1.6">
                Puedes descargar directamente el contacto VCF con el botón superior para mandarlo a tu lista negra o bloquearlo desde la app de Teléfono de tu celular (Android o iPhone) en el registro de llamadas recientes.
            </p>
        </div>
    </div>

    <!-- EEAT Author Box (Víctor Alonso) -->
    <div class="eeat-author-card">
        <img src="{{ asset('images/victor-alonso.webp') }}" alt="Víctor Alonso" class="eeat-avatar">
        <div class="eeat-info">
            <h4>Revisado y auditado por Víctor Alonso</h4>
            <p>Especialista en Desarrollo Web y SEO. Creador de QuiénLlama, comprometido con la transparencia en telecomunicaciones y la protección ciudadana frente a extorsiones, fraudes y spam telefónico en México, España, Chile y Argentina.</p>
            <div class="eeat-links">
                <a href="https://victor-alonso.es" target="_blank" rel="noopener noreferrer">🌍 victor-alonso.es</a> ·
                <a href="https://www.linkedin.com/in/vialonso/" target="_blank" rel="noopener noreferrer">💼 LinkedIn</a> ·
                <a href="{{ route('legal.about') }}">ℹ️ Sobre el autor</a>
            </div>
        </div>
    </div>
</div>

<script>
function copyNumber(num) {
    navigator.clipboard.writeText(num).then(() => {
        alert('Número copiado al portapapeles: ' + num);
    });
}
</script>

<!-- Schema.org FAQPage -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    {
      "@@type": "Question",
      "name": "¿De quién es el número {{ $formatted }}?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "El número {{ $formatted }} corresponde a una línea con clave LADA {{ $phone->area_code }} de {{ $phone->location ?: 'México' }}."
      }
    },
    {
      "@@type": "Question",
      "name": "¿Cómo bloquear las llamadas de {{ $formatted }} en México?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "Puedes bloquearlo desde el menú de llamadas recientes de tu celular Android o iPhone, o descargando la tarjeta VCF desde mx.quienllama.com.es."
      }
    }
  ]
}
</script>
@endsection
