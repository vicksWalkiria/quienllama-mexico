@extends('layouts.app')

@section('title', 'Quién Llama México App Android - Bloqueador de Extorsión, Cobranza y Spam')
@section('meta_description', 'Descarga gratis la app oficial de QuiénLlama México para Android en Google Play. Bloquea llamadas de extorsión, bancos, cobranza y spam en menos de 2 ms en tu celular.')

@section('content')
<div class="app-landing">
    <!-- JSON-LD SoftwareApplication -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "SoftwareApplication",
        "name": "Quién Llama México",
        "operatingSystem": "ANDROID",
        "applicationCategory": "UtilitiesApplication",
        "offers": {
            "@@type": "Offer",
            "price": "0.00",
            "priceCurrency": "MXN"
        },
        "aggregateRating": {
            "@@type": "AggregateRating",
            "ratingValue": "5.0",
            "ratingCount": "48"
        },
        "description": "Identificador y bloqueador de llamadas de extorsión, bancos, despachos de cobranza y spam telefónico en México.",
        "image": "{{ asset('images/app/icon_512x512.png') }}",
        "screenshot": [
            "{{ asset('images/app/01_historial_llamadas_bloqueadas.png') }}",
            "{{ asset('images/app/02_detalle_numero_comentarios.png') }}",
            "{{ asset('images/app/03_reportar_numero_sospechoso.png') }}",
            "{{ asset('images/app/05_proteccion_total_pro.png') }}"
        ],
        "downloadUrl": "https://play.google.com/store/apps/details?id=com.walkiria.quienllama",
        "author": {
            "@@type": "Person",
            "name": "Víctor Alonso",
            "url": "https://victor-alonso.es"
        }
    }
    </script>

    <!-- HERO SECTION -->
    <section class="app-hero">
        <div class="app-hero-content">
            <div class="app-hero-badge">
                <span class="badge-pulse"></span>
                <span>🇲🇽 App Oficial Android para México en Google Play</span>
            </div>
            <h1 class="app-hero-title">
                Bloquea llamadas de extorsión, bancos y spam <span class="gradient-text">antes de que timbre tu celular</span>
            </h1>
            <p class="app-hero-subtitle">
                Recupera tu paz mental. QuiénLlama para Android cuelga en segundo plano las llamadas molestas de cobranza agresiva, fraudes de paquetería, secuestros virtuales y call centers en menos de <strong>2 milisegundos</strong> con la base de datos comunitaria de México.
            </p>

            <div class="app-hero-actions">
                <a href="https://play.google.com/store/apps/details?id=com.walkiria.quienllama" target="_blank" rel="noopener noreferrer" class="btn-playstore-primary" onclick="if(typeof trackGoal==='function'){trackGoal('app_download_click', {event_label:'landing_hero_mx', destination:'playstore'});}">
                    <svg viewBox="0 0 512 512" width="26" height="26" fill="currentColor" aria-hidden="true">
                        <path d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z"/>
                    </svg>
                    <div class="btn-playstore-text">
                        <span class="btn-sub">DISPONIBLE EN</span>
                        <span class="btn-main">Google Play</span>
                    </div>
                </a>
                <a href="#capturas" class="btn-ghost-secondary">
                    <span>Ver capturas de pantalla</span>
                    <span>↓</span>
                </a>
            </div>

            <div class="app-hero-badges-list">
                <span class="pill-badge">⚡ Bloqueo en &lt; 2 ms</span>
                <span class="pill-badge">🔒 0% Acceso a contactos</span>
                <span class="pill-badge">🔋 0% Gasto de batería</span>
                <span class="pill-badge">🇲🇽 Especializado en claves LADA de México</span>
            </div>
        </div>

        <div class="app-hero-preview">
            <div class="phone-mockup-wrap">
                <div class="phone-glow"></div>
                <img src="{{ asset('images/app/01_historial_llamadas_bloqueadas.png') }}" alt="Quién Llama Android México - Historial de llamadas bloqueadas" class="phone-mockup-img" loading="eager" width="320" height="690">
            </div>
        </div>
    </section>

    <!-- HIGHLIGHT STATS / PILLARS -->
    <section class="app-pillars-grid">
        <div class="pillar-card">
            <div class="pillar-icon">⚡</div>
            <h3>Cuelgue Silencioso en 2 ms</h3>
            <p>A través de la API oficial de Android (CallScreeningService), tu celular <strong>no llega a sonar ni vibrar</strong>. El número de extorsión o spam se corta al instante.</p>
        </div>

        <div class="pillar-card highlight-pillar">
            <div class="pillar-icon">🛡️</div>
            <h3>100% Respeto a tu Privacidad</h3>
            <p>Otras apps comerciales te obligan a subir toda tu agenda de contactos a la nube para venderla a empresas. QuiénLlama <strong>NUNCA te pide acceso a tus contactos</strong> ni a tus fotos.</p>
        </div>

        <div class="pillar-card">
            <div class="pillar-icon">📡</div>
            <h3>Protección Sin Datos ni Wi-Fi</h3>
            <p>La base de datos de números denunciados en México se almacena de forma compacta en tu dispositivo. Te protege aunque estés en el metro, carretera o sin saldo.</p>
        </div>

        <div class="pillar-card">
            <div class="pillar-icon">🚫</div>
            <h3>Freno a Extorsión y Cobranza</h3>
            <p>Especialmente entrenada para neutralizar llamadas de intimidación, amenazas de supuestos cárteles, despachos de cobranza ilegal y promociones bancarias insistentes.</p>
        </div>
    </section>

    <!-- SCREENSHOTS SHOWCASE -->
    <section class="app-screenshots-section" id="capturas">
        <div class="section-heading text-center">
            <span class="subheading-tag">INTERFAZ LIMPIA Y FLUIDA</span>
            <h2>Diseñada para "Instalar y Olvidarte del Spam"</h2>
            <p>Sin configuraciones complejas, con modo oscuro elegante y diseñada para proteger tu celular las 24 horas del día.</p>
        </div>

        <div class="screenshots-scroll-container">
            <div class="screenshot-card">
                <img src="{{ asset('images/app/01_historial_llamadas_bloqueadas.png') }}" alt="Historial de llamadas de extorsión y spam bloqueadas en México" loading="lazy" width="280">
                <h4>Historial en Vivo</h4>
                <p>Revisa en cualquier momento qué números intentaron marcarte y el motivo del bloqueo.</p>
            </div>

            <div class="screenshot-card">
                <img src="{{ asset('images/app/02_detalle_numero_comentarios.png') }}" alt="Detalle del número con denuncias comunitarias" loading="lazy" width="280">
                <h4>Detalle y Denuncias</h4>
                <p>Consulta las experiencias y advertencias de otros mexicanos sobre cada número.</p>
            </div>

            <div class="screenshot-card">
                <img src="{{ asset('images/app/03_reportar_numero_sospechoso.png') }}" alt="Formulario para reportar números sospechosos en México" loading="lazy" width="280">
                <h4>Reporte con 1 Toque</h4>
                <p>Alerta a toda la comunidad de un nuevo fraude o intento de extorsión de inmediato.</p>
            </div>

            <div class="screenshot-card">
                <img src="{{ asset('images/app/04_seleccion_pais_cobertura.png') }}" alt="Cobertura multirregión con claves LADA" loading="lazy" width="280">
                <h4>Cobertura Total México</h4>
                <p>Compatible con todas las claves LADA (55, 33, 81 y las más de 390 claves del país).</p>
            </div>

            <div class="screenshot-card">
                <img src="{{ asset('images/app/05_proteccion_total_pro.png') }}" alt="Protección PRO de por vida" loading="lazy" width="280">
                <h4>Opción PRO de Por Vida</h4>
                <p>Actualizaciones automáticas continuas de números y experiencia 100% sin publicidad.</p>
            </div>

            <div class="screenshot-card">
                <img src="{{ asset('images/app/06_acerca_de_privacidad.png') }}" alt="Privacidad y transparencia" loading="lazy" width="280">
                <h4>Sin Rastreadores Ocultos</h4>
                <p>Desarrollada bajo estándares éticos de protección de datos personales.</p>
            </div>
        </div>
    </section>

    <!-- COMPARISON TABLE -->
    <section class="app-comparison-section">
        <div class="section-heading text-center">
            <span class="subheading-tag">COMPARATIVA TRANSPARENTE</span>
            <h2>¿Por qué QuiénLlama México frente a otras apps?</h2>
            <p>La mayoría de identificadores se convierten en una amenaza para tu propia privacidad al comercializar tu agenda.</p>
        </div>

        <div class="comparison-table-wrapper">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Característica</th>
                        <th class="col-highlight">QuiénLlama México</th>
                        <th>Otras Apps (Truecaller, etc.)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Acceso a tu lista de Contactos</strong></td>
                        <td class="col-highlight"><span class="badge-success">❌ CERO acceso (100% privado)</span></td>
                        <td><span class="badge-danger">⚠️ Suben tus contactos a servidores</span></td>
                    </tr>
                    <tr>
                        <td><strong>Bloqueo nativo del sistema</strong></td>
                        <td class="col-highlight">✅ &lt; 2 ms (CallScreening API)</td>
                        <td>⚠️ Retardo (hace sonar el celular)</td>
                    </tr>
                    <tr>
                        <td><strong>Modo Offline (Sin Saldo / Sin Red)</strong></td>
                        <td class="col-highlight">✅ Sí (Base de datos local en el celular)</td>
                        <td>❌ Requiere datos móviles siempre</td>
                    </tr>
                    <tr>
                        <td><strong>Rastreo de ubicación</strong></td>
                        <td class="col-highlight">✅ Ninguno</td>
                        <td>⚠️ Geolocalización para anuncios</td>
                    </tr>
                    <tr>
                        <td><strong>Modelo de Precios</strong></td>
                        <td class="col-highlight"><strong>Gratis para siempre</strong> (Opción PRO única $149 MXN)</td>
                        <td>Suscripciones mensuales recurrentes caras</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- FAQ ACCORDION -->
    <section class="app-faq-section">
        <div class="section-heading text-center">
            <span class="subheading-tag">DUDAS FRECUENTES</span>
            <h2>Preguntas Frecuentes sobre la App en México</h2>
        </div>

        <div class="faq-list">
            <details class="faq-item">
                <summary class="faq-question">
                    <span>¿Cómo se activa el bloqueo de llamadas en Android?</span>
                    <span class="faq-icon">+</span>
                </summary>
                <div class="faq-answer">
                    <p>Al abrir la app por primera vez, el sistema Android te solicitará activar <strong>QuiénLlama</strong> como tu identificador de llamadas y app de spam predeterminada (CallScreeningService). Solo confirma en la pantalla del sistema y la app comenzará a protegerte automáticamente.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary class="faq-question">
                    <span>¿Realmente bloquea llamadas de extorsión y despachos de cobranza?</span>
                    <span class="faq-icon">+</span>
                </summary>
                <div class="faq-answer">
                    <p>Sí. Nuestra base de datos comunitaria se alimenta de los miles de reportes diarios de usuarios en México que señalan números de extorsión telefónica, cobradores de préstamos ilegales (montadeudas) y despachos bancarios que marcan a todas horas.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary class="faq-question">
                    <span>¿Es gratis la aplicación en México?</span>
                    <span class="faq-icon">+</span>
                </summary>
                <div class="faq-answer">
                    <p>Sí, la app es completamente gratuita. Puedes descargar la lista comunitaria de spam, buscar números y bloquear llamadas sin costo alguno. Opcionalmente, contamos con una versión PRO de pago único de por vida ($149 MXN) para sincronización automática en segundo plano y cero publicidad.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary class="faq-question">
                    <span>¿Por qué no solicita permiso para ver mis contactos?</span>
                    <span class="faq-icon">+</span>
                </summary>
                <div class="faq-answer">
                    <p>Porque creemos firmemente en la privacidad. QuiénLlama solo analiza el número que está marcando para comprobar si está catalogado como spam en nuestra base de datos. No necesita, ni quiere, acceder a tus contactos personales ni a tus mensajes.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary class="faq-question">
                    <span>¿Gasta la batería de mi celular?</span>
                    <span class="faq-icon">+</span>
                </summary>
                <div class="faq-answer">
                    <p>No. A diferencia de otras apps que se quedan ejecutando procesos pesados en segundo plano, QuiénLlama utiliza el servicio nativo de Android que solo se activa durante una fracción de segundo en el instante exacto en que entra una llamada entrante.</p>
                </div>
            </details>
        </div>
    </section>

    <!-- BOTTOM CTA BANNER -->
    <section class="app-cta-banner">
        <div class="cta-banner-inner">
            <div class="cta-banner-icon">
                <img src="{{ asset('images/app/icon_512x512.png') }}" alt="Logo Quién Llama México" width="72" height="72" style="border-radius:18px; box-shadow:0 4px 15px rgba(0,0,0,0.3);">
            </div>
            <div class="cta-banner-text">
                <h3>Descarga Quién Llama en México y frena el SPAM hoy</h3>
                <p>Protege tu celular contra extorsiones y call centers. Descarga oficial rápida y segura desde Google Play.</p>
            </div>
            <div class="cta-banner-btn-wrap">
                <a href="https://play.google.com/store/apps/details?id=com.walkiria.quienllama" target="_blank" rel="noopener noreferrer" class="btn-playstore-primary" onclick="if(typeof trackGoal==='function'){trackGoal('app_download_click', {event_label:'landing_bottom_mx', destination:'playstore'});}">
                    <svg viewBox="0 0 512 512" width="24" height="24" fill="currentColor" aria-hidden="true">
                        <path d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z"/>
                    </svg>
                    <div class="btn-playstore-text">
                        <span class="btn-sub">DISPONIBLE EN</span>
                        <span class="btn-main">Google Play</span>
                    </div>
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

@section('styles')
<style>
/* ===== ESTILOS LANDING APP QUIÉN LLAMA MÉXICO ===== */
.app-landing {
    padding: 1.5rem 0 3rem;
}

/* Hero */
.app-hero {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 3rem;
    align-items: center;
    margin-bottom: 4rem;
    padding: 2.5rem 0 1rem;
}

.app-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(0, 104, 71, 0.15);
    border: 1px solid rgba(0, 104, 71, 0.4);
    color: #86efac;
    font-size: 0.85rem;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 9999px;
    margin-bottom: 1.25rem;
}

.badge-pulse {
    width: 8px;
    height: 8px;
    background: #22c55e;
    border-radius: 50%;
    box-shadow: 0 0 8px #22c55e;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(0.95); opacity: 0.8; }
    50% { transform: scale(1.3); opacity: 1; }
    100% { transform: scale(0.95); opacity: 0.8; }
}

.app-hero-title {
    font-size: 2.5rem;
    font-weight: 900;
    line-height: 1.18;
    color: var(--text-main, #ffffff);
    margin-bottom: 1.2rem;
    letter-spacing: -0.02em;
}

.gradient-text {
    background: linear-gradient(135deg, #86efac 0%, #22c55e 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.app-hero-subtitle {
    font-size: 1.1rem;
    line-height: 1.65;
    color: var(--text-muted, #94a3b8);
    margin-bottom: 2rem;
}

.app-hero-actions {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
}

.btn-playstore-primary {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: #004d34;
    color: #ffffff !important;
    padding: 12px 24px;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 700;
    box-shadow: 0 8px 20px -4px rgba(0, 104, 71, 0.45);
    border: 1px solid rgba(134, 239, 172, 0.3);
    transition: all 0.2s ease;
}

.btn-playstore-primary:hover {
    background: #006847;
    border-color: #86efac;
    transform: translateY(-2px);
    box-shadow: 0 12px 24px -4px rgba(0, 104, 71, 0.6);
    color: #ffffff !important;
}

.btn-playstore-text {
    display: flex;
    flex-direction: column;
    text-align: left;
    line-height: 1.15;
}

.btn-playstore-text .btn-sub {
    font-size: 0.65rem;
    letter-spacing: 0.08em;
    opacity: 0.85;
    font-weight: 600;
}

.btn-playstore-text .btn-main {
    font-size: 1.2rem;
    font-weight: 800;
    letter-spacing: 0.02em;
}

.btn-ghost-secondary {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--text-main, #ffffff);
    font-weight: 700;
    font-size: 0.95rem;
    padding: 12px 18px;
    text-decoration: none;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.08);
    transition: all 0.2s;
}

.btn-ghost-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #86efac !important;
}

.app-hero-badges-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.pill-badge {
    font-size: 0.78rem;
    font-weight: 600;
    background: var(--surface, #0d221b);
    color: var(--text-muted, #94a3b8);
    border: 1px solid var(--border, rgba(255, 255, 255, 0.1));
    padding: 5px 12px;
    border-radius: 9999px;
}

/* Phone Mockup */
.app-hero-preview {
    display: flex;
    justify-content: center;
    position: relative;
}

.phone-mockup-wrap {
    position: relative;
    max-width: 310px;
}

.phone-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 280px;
    height: 480px;
    background: radial-gradient(circle, rgba(0, 104, 71, 0.35) 0%, rgba(34, 197, 94, 0.2) 50%, transparent 70%);
    filter: blur(40px);
    z-index: 0;
}

.phone-mockup-img {
    position: relative;
    z-index: 1;
    width: 100%;
    height: auto;
    border-radius: 36px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 0 8px #003322;
}

/* Pillars */
.app-pillars-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.5rem;
    margin-bottom: 5rem;
}

.pillar-card {
    background: var(--surface, #0c201a);
    border: 1px solid var(--border, rgba(255, 255, 255, 0.08));
    border-radius: 18px;
    padding: 1.8rem;
    transition: transform 0.2s, box-shadow 0.2s;
}

.pillar-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px -6px rgba(0, 104, 71, 0.2);
    border-color: rgba(134, 239, 172, 0.3);
}

.highlight-pillar {
    background: linear-gradient(135deg, rgba(0, 104, 71, 0.25) 0%, rgba(13, 34, 27, 0.9) 100%);
    border: 1.5px solid #22c55e;
}

.pillar-icon {
    font-size: 2rem;
    margin-bottom: 0.85rem;
}

.pillar-card h3 {
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--text-main, #ffffff);
    margin-bottom: 0.6rem;
}

.pillar-card p {
    font-size: 0.92rem;
    line-height: 1.55;
    color: var(--text-muted, #94a3b8);
    margin: 0;
}

/* Screenshots Showcase */
.app-screenshots-section {
    margin-bottom: 5rem;
}

.section-heading {
    max-width: 680px;
    margin: 0 auto 2.5rem;
}

.subheading-tag {
    display: inline-block;
    color: #86efac;
    font-size: 0.8rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    margin-bottom: 0.5rem;
}

.section-heading h2 {
    font-size: 2rem;
    font-weight: 900;
    color: var(--text-main, #ffffff);
    margin-bottom: 0.75rem;
}

.section-heading p {
    font-size: 1rem;
    color: var(--text-muted, #94a3b8);
    line-height: 1.6;
}

.screenshots-scroll-container {
    display: flex;
    gap: 1.5rem;
    overflow-x: auto;
    padding: 1rem 0.5rem 2rem;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
}

.screenshots-scroll-container::-webkit-scrollbar {
    height: 8px;
}

.screenshots-scroll-container::-webkit-scrollbar-thumb {
    background: #006847;
    border-radius: 9999px;
}

.screenshot-card {
    flex: 0 0 260px;
    scroll-snap-align: center;
    background: var(--surface, #0d221b);
    border: 1px solid var(--border, rgba(255, 255, 255, 0.08));
    border-radius: 20px;
    padding: 1rem;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.screenshot-card img {
    width: 100%;
    height: auto;
    border-radius: 16px;
    margin-bottom: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.screenshot-card h4 {
    font-size: 1rem;
    font-weight: 800;
    color: var(--text-main, #ffffff);
    margin-bottom: 0.35rem;
}

.screenshot-card p {
    font-size: 0.82rem;
    line-height: 1.45;
    color: var(--text-muted, #94a3b8);
    margin: 0;
}

/* Comparison Table */
.app-comparison-section {
    margin-bottom: 5rem;
}

.comparison-table-wrapper {
    max-width: 860px;
    margin: 0 auto;
    overflow-x: auto;
    background: var(--surface, #0d221b);
    border: 1px solid var(--border, rgba(255, 255, 255, 0.08));
    border-radius: 18px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
}

.comparison-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
}

.comparison-table th, 
.comparison-table td {
    padding: 1.15rem 1.4rem;
    text-align: left;
    border-bottom: 1px solid var(--border, rgba(255, 255, 255, 0.08));
}

.comparison-table th {
    background: rgba(0, 104, 71, 0.3);
    font-weight: 800;
    color: var(--text-main, #ffffff);
}

.comparison-table .col-highlight {
    background: rgba(0, 104, 71, 0.15);
    color: #86efac;
}

.badge-success {
    color: #86efac;
    background: rgba(34, 197, 94, 0.2);
    border: 1px solid rgba(34, 197, 94, 0.4);
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 0.82rem;
    font-weight: 700;
    display: inline-block;
}

.badge-danger {
    color: #fca5a5;
    background: rgba(239, 68, 68, 0.2);
    border: 1px solid rgba(239, 68, 68, 0.4);
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 0.82rem;
    font-weight: 700;
    display: inline-block;
}

/* FAQ */
.app-faq-section {
    max-width: 800px;
    margin: 0 auto 5rem;
}

.faq-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.faq-item {
    background: var(--surface, #0d221b);
    border: 1px solid var(--border, rgba(255, 255, 255, 0.08));
    border-radius: 14px;
    overflow: hidden;
    transition: all 0.2s ease;
}

.faq-question {
    padding: 1.25rem 1.4rem;
    font-weight: 800;
    font-size: 1rem;
    color: var(--text-main, #ffffff);
    cursor: pointer;
    list-style: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.faq-question::-webkit-details-marker {
    display: none;
}

.faq-icon {
    font-size: 1.3rem;
    color: #86efac;
    font-weight: 700;
    transition: transform 0.2s;
}

.faq-item[open] .faq-icon {
    transform: rotate(45deg);
}

.faq-answer {
    padding: 0 1.4rem 1.25rem;
    font-size: 0.92rem;
    line-height: 1.65;
    color: var(--text-muted, #94a3b8);
}

/* Bottom CTA Banner */
.app-cta-banner {
    background: linear-gradient(135deg, #003322 0%, #004d34 50%, #002619 100%);
    border-radius: 24px;
    padding: 2.5rem 2rem;
    color: #ffffff;
    box-shadow: 0 15px 35px -5px rgba(0, 104, 71, 0.35);
    border: 1px solid rgba(134, 239, 172, 0.3);
}

.cta-banner-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
}

.cta-banner-icon {
    flex-shrink: 0;
}

.cta-banner-text h3 {
    font-size: 1.5rem;
    font-weight: 900;
    margin: 0 0 0.5rem;
    color: #ffffff;
}

.cta-banner-text p {
    font-size: 0.98rem;
    line-height: 1.5;
    color: rgba(255, 255, 255, 0.85);
    margin: 0;
}

.cta-banner-btn-wrap {
    flex-shrink: 0;
}

/* Responsive */
@media (max-width: 900px) {
    .app-hero {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 2rem;
    }
    .app-hero-title {
        font-size: 2rem;
    }
    .app-hero-actions {
        justify-content: center;
    }
    .app-hero-badges-list {
        justify-content: center;
    }
    .cta-banner-inner {
        flex-direction: column;
        text-align: center;
    }
    .cta-banner-btn-wrap {
        width: 100%;
    }
    .cta-banner-btn-wrap .btn-playstore-primary {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
