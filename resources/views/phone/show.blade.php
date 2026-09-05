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

    /* Social Share Box */
    .share-alert-box {
        margin-top: 1.25rem;
        background: #fffbeb;
        border: 1.5px solid #fde68a;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        text-align: left;
    }
    .share-alert-header {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .share-alert-header strong {
        font-size: 0.95rem;
        color: #92400e;
        display: block;
    }
    .share-alert-header span {
        font-size: 0.84rem;
        color: #b45309;
        display: block;
    }
    .share-alert-buttons {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        flex-wrap: wrap;
    }
    .btn-share {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.55rem 1.1rem;
        border-radius: 9999px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        color: white;
        border: none;
        cursor: pointer;
        transition: transform 0.15s, box-shadow 0.15s;
    }
    .btn-share:hover {
        transform: translateY(-1px);
    }
    .btn-share-wa {
        background: #25d366;
        box-shadow: 0 2px 6px rgba(37, 211, 102, 0.3);
    }
    .btn-share-wa:hover {
        background: #1ebd58;
    }
    .btn-share-tg {
        background: #0088cc;
        box-shadow: 0 2px 6px rgba(0, 136, 204, 0.3);
    }
    .btn-share-tg:hover {
        background: #0077b5;
    }
    .btn-share-x {
        background: #0f172a;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.25);
    }
    .btn-share-x:hover {
        background: #1e293b;
    }
    .btn-share-copy {
        background: #ffffff;
        color: #92400e;
        border: 1.5px solid #d97706;
        box-shadow: 0 2px 5px rgba(217, 119, 6, 0.15);
    }
    .btn-share-copy:hover {
        background: #fef3c7;
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
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 8px !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }
        .action-btn-row .btn-action {
            width: 100% !important;
            box-sizing: border-box !important;
            justify-content: center !important;
            text-align: center !important;
            font-size: 0.82rem !important;
            padding: 9px 8px !important;
            white-space: normal !important;
            line-height: 1.25 !important;
            border-radius: 10px !important;
        }
        .action-btn-row .btn-nollame {
            grid-column: 1 / -1 !important;
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
                🚫 Descargar VCF
            </a>

            <a href="{{ route('legal.no-molestar') }}" class="btn-action btn-nollame">
                ⚖️ REPEP PROFECO / REUS
            </a>

        </div>

        <!-- Alerta para Compartir por Redes Sociales -->
        <div class="share-alert-box">
            <div class="share-alert-header">
                <span style="font-size: 1.6rem; line-height: 1;">📢</span>
                <div>
                    <strong>¡Advierte a tus contactos sobre este número!</strong>
                    <span>Si te marcaron, comparte esta ficha para prevenir fraudes y extorsiones en México.</span>
                </div>
            </div>
            <div class="share-alert-buttons">
                <a href="https://api.whatsapp.com/send?text={{ urlencode('¡Cuidado! Si te marcan de este número no contestes: ' . $formatted . '. Checa más reportes y denuncias en ' . url()->current()) }}" 
                   target="_blank" rel="noopener noreferrer" class="btn-share btn-share-wa" 
                   onclick="trackSocialShare('whatsapp', '{{ $phone->number }}')">
                    <svg width="17" height="17" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.541 1.948.825 2.796.825 3.183 0 5.768-2.586 5.769-5.766.001-3.182-2.585-5.768-5.769-5.768zm0-2.172c4.378 0 7.938 3.559 7.938 7.938 0 4.378-3.56 7.938-7.938 7.938-1.282 0-2.522-.315-3.626-.893l-4.405 1.155 1.176-4.298c-.672-1.168-1.083-2.482-1.083-3.902 0-4.379 3.56-7.938 7.938-7.938z"/></svg>
                    WhatsApp
                </a>

                <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode('¡Cuidado! Si te marcan de este número no contestes: ' . $formatted . '. Checa más reportes y denuncias:') }}" 
                   target="_blank" rel="noopener noreferrer" class="btn-share btn-share-tg" 
                   onclick="trackSocialShare('telegram', '{{ $phone->number }}')">
                    <svg width="17" height="17" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.75-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/></svg>
                    Telegram
                </a>

                <a href="https://twitter.com/intent/tweet?text={{ urlencode('¡Cuidado! Si te marcan de este número no contestes: ' . $formatted . '. Checa más reportes y denuncias en ' . url()->current()) }}" 
                   target="_blank" rel="noopener noreferrer" class="btn-share btn-share-x" 
                   onclick="trackSocialShare('x_twitter', '{{ $phone->number }}')">
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    Compartir en 𝕏
                </a>

                <button type="button" class="btn-share btn-share-copy" id="btnCopyAlert" onclick="shareAlertNative('{{ $phone->number }}', '{{ $formatted }}', '{{ url()->current() }}', '¡Cuidado! Si te marcan de este número no contestes: {{ $formatted }}. Checa más reportes y denuncias en {{ url()->current() }}')">
                    <span>🔗</span> Compartir Alerta
                </button>
            </div>
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

    <!-- Community Telegram Banner CTA -->
    <div class="telegram-banner-cta">
        <div class="telegram-banner-content">
            <div class="telegram-banner-icon">
                <svg width="34" height="34" viewBox="0 0 24 24" fill="#ffffff"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.75-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/></svg>
            </div>
            <div class="telegram-banner-text">
                <p class="telegram-banner-title" style="font-size: 1.15rem; font-weight: 800; color: #ffffff; margin: 0 0 0.25rem;">💬 ¿Cansado de llamadas sospechosas y fraudes?</p>
                <p>Únete a la comunidad oficial de <strong>QuiénLlama México 🇲🇽</strong> en Telegram. Recibe alertas en tiempo real sobre nuevos números reportados antes de contestar.</p>
            </div>
        </div>
        <a href="https://t.me/+C91vWOozJvI4NzJk" target="_blank" rel="noopener noreferrer" class="telegram-banner-btn" onclick="if(typeof trackGoal==='function'){trackGoal('join_telegram_community', {event_label:'phone_show_banner'});}">
            <span>Unirme al Grupo ➔</span>
        </a>
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
            <div style="display:none !important;" aria-hidden="true">
                <input type="text" name="website_hp" tabindex="-1" autocomplete="off">
            </div>
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

function trackSocialShare(network, phone) {
    if (typeof window.trackGoal === 'function') {
        window.trackGoal('share_social', {
            network: network,
            phone_number: phone,
            event_label: network + '_' + phone
        });
    }
}

function shareAlertNative(phone, formatted, url, fullText) {
    trackSocialShare('native_or_copy', phone);
    if (navigator.share) {
        navigator.share({
            title: '¡Cuidado con el ' + formatted + '!',
            text: fullText,
            url: url
        }).catch(function() {});
    } else if (navigator.clipboard) {
        navigator.clipboard.writeText(fullText).then(function() {
            var btn = document.getElementById('btnCopyAlert');
            if (btn) {
                var orig = btn.innerHTML;
                btn.innerHTML = '✅ ¡Alerta copiada!';
                setTimeout(function() { btn.innerHTML = orig; }, 2500);
            }
        });
    }
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
