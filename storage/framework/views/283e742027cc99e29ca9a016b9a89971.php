<?php $__env->startSection('title', 'Quién Llama México - Saber a quién pertenece un número de teléfono gratis'); ?>
<?php $__env->startSection('meta_description', 'Introduce un número de teléfono celular o fijo a 10 dígitos y descubre gratis a quién pertenece en México. Identifica llamadas de bancos, cobranza, extorsión y telemarketing.'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    /* Search Section (Estilo Clásico QuiénLlama) */
    .search-section {
        text-align: center;
        padding: 2.5rem 1rem 2rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .search-section h1 {
        font-size: 2.3rem;
        font-weight: 900;
        letter-spacing: -0.7px;
        color: var(--text-main);
        line-height: 1.2;
        margin-bottom: 0.75rem;
    }

    .search-section p {
        font-size: 1.05rem;
        color: var(--text-muted);
        line-height: 1.5;
        margin-bottom: 1.75rem;
    }

    .search-form-wrapper {
        position: relative;
        max-width: 600px;
        margin: 0 auto;
    }

    .search-form {
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 2px solid var(--primary);
        border-radius: 9999px;
        padding: 0.35rem 0.45rem 0.35rem 1.4rem;
        box-shadow: 0 10px 25px -5px rgba(0, 104, 71, 0.2);
        transition: box-shadow 0.2s;
    }

    .search-form:focus-within {
        box-shadow: 0 12px 30px -4px rgba(0, 104, 71, 0.3);
    }

    .search-form input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
        background: transparent;
    }

    .search-form .btn-search {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.8rem 1.75rem;
        border-radius: 9999px;
        font-weight: 800;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
        white-space: nowrap;
    }

    .search-form .btn-search:hover {
        background: var(--primary-hover);
        transform: scale(1.02);
    }

    /* Quick Action Pills */
    .quick-actions {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .qa-pill-danger {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        background: #fee2e2;
        color: #b91c1c;
        border: 1.5px solid #fca5a5;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 0.45rem 1rem;
        border-radius: 9999px;
        text-decoration: none;
        transition: background 0.15s;
    }

    .qa-pill-danger:hover {
        background: #fecaca;
    }

    .qa-pill-blue {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        background: #f0fdf4;
        color: #15803d;
        border: 1.5px solid #86efac;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 0.45rem 1rem;
        border-radius: 9999px;
        text-decoration: none;
        transition: background 0.15s;
    }

    .qa-pill-blue:hover {
        background: #dcfce7;
    }

    /* VCF Promo Banner */
    .vcf-promo-banner {
        margin-top: 2rem;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border: 1.5px dashed var(--border);
        border-radius: var(--radius-lg);
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        text-align: left;
    }

    .vcf-promo-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .vcf-promo-icon {
        font-size: 2rem;
        flex-shrink: 0;
    }

    .vcf-promo-text strong {
        display: block;
        font-size: 1rem;
        color: var(--text-main);
        margin-bottom: 0.2rem;
    }

    .vcf-promo-text span {
        font-size: 0.88rem;
        color: var(--text-muted);
        line-height: 1.4;
    }

    .vcf-promo-btn {
        background: #0f172a;
        color: white;
        padding: 0.65rem 1.25rem;
        border-radius: 9999px;
        font-size: 0.88rem;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
        transition: background 0.2s;
        flex-shrink: 0;
    }

    .vcf-promo-btn:hover {
        background: #1e293b;
    }

    /* Section Header */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: 1.25rem;
        border-bottom: 2px solid var(--border);
        padding-bottom: 0.5rem;
    }

    .section-header h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Pills Grid */
    .pills-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        margin-bottom: 3rem;
    }

    .phone-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.45rem 0.85rem;
        border-radius: 9999px;
        font-size: 0.9rem;
        font-weight: 700;
        text-decoration: none;
        transition: transform 0.1s, box-shadow 0.1s;
    }

    .phone-pill:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .pill-danger {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .pill-neutral {
        background: #f1f5f9;
        color: var(--text-main);
        border: 1px solid var(--border);
    }

    .pill-badge {
        font-size: 0.72rem;
        padding: 0.15rem 0.4rem;
        border-radius: 9999px;
        background: rgba(0, 0, 0, 0.06);
    }

    /* Report CTA Section */
    .report-cta-section {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2.25rem 1.5rem;
        margin-bottom: 3rem;
    }

    /* EEAT Author Card */
    .eeat-author-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 3rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .eeat-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary);
        flex-shrink: 0;
    }

    .eeat-info h4 {
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 0.25rem;
    }

    .eeat-info p {
        font-size: 0.88rem;
        color: var(--text-muted);
        line-height: 1.5;
        margin-bottom: 0.5rem;
    }

    .eeat-links {
        display: flex;
        gap: 0.85rem;
        flex-wrap: wrap;
    }

    .eeat-links a {
        font-size: 0.82rem;
        color: var(--primary);
        font-weight: 700;
        text-decoration: none;
    }

    /* FAQs */
    .faqs {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2rem;
        margin-bottom: 3rem;
        box-shadow: var(--shadow-sm);
    }

    .faqs h3 {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 1.25rem;
    }

    .faqs details {
        border-bottom: 1px solid var(--border);
        padding: 1rem 0;
    }

    .faqs details:last-child {
        border-bottom: none;
    }

    .faqs summary {
        font-weight: 700;
        font-size: 1rem;
        color: var(--text-main);
        cursor: pointer;
        user-select: none;
        outline: none;
    }

    .faqs summary:hover {
        color: var(--primary);
    }

    .faq-content {
        margin-top: 0.65rem;
        color: var(--text-muted);
        font-size: 0.92rem;
        line-height: 1.6;
    }

    @media (max-width: 640px) {
        .search-section {
            padding: 1.5rem 0.5rem 1.25rem;
        }
        .search-section h1 {
            font-size: 1.65rem;
            line-height: 1.25;
        }
        .search-section p {
            font-size: 0.95rem;
            margin-bottom: 1.25rem;
        }
        .search-form {
            flex-direction: column;
            border-radius: var(--radius);
            padding: 0.5rem;
            gap: 0.5rem;
        }
        .search-form input {
            text-align: center;
            padding: 0.6rem 0.5rem;
            font-size: 1rem;
        }
        .search-form .btn-search {
            width: 100%;
            border-radius: var(--radius);
            padding: 0.75rem 1rem;
        }
        .quick-actions {
            flex-direction: column;
            width: 100%;
            gap: 0.5rem;
        }
        .quick-actions a {
            width: 100%;
            text-align: center;
            justify-content: center;
        }
        .vcf-promo-banner {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem 1rem;
            gap: 0.85rem;
        }
        .vcf-promo-left {
            flex-direction: column;
            text-align: center;
        }
        .vcf-promo-btn {
            width: 100%;
            text-align: center;
            display: block;
        }
        .section-header {
            flex-direction: column;
            text-align: center;
            align-items: center;
            gap: 0.25rem;
        }
        .pills-grid {
            justify-content: center;
        }
        .eeat-author-card {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem 1rem;
            gap: 1rem;
        }
        .eeat-avatar {
            margin: 0 auto;
        }
        .faqs {
            padding: 1.25rem 1rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Hero Search Section -->
    <section class="search-section">
        <h1>¿Quién te llama a tu celular?</h1>
        <p>Introduce cualquier número a 10 dígitos y descubre gratis a quién pertenece en México, si es de banco, cobranza, spam o intento de extorsión.</p>

        <div class="search-form-wrapper">
            <form action="<?php echo e(route('search')); ?>" method="GET" class="search-form">
                <input type="tel" name="q" placeholder="Introduce el número a 10 dígitos (ej: 55 8898 2939, 33 1234 5678...)" autofocus required>
                <button type="submit" class="btn-search">Buscar Gratis</button>
            </form>
        </div>

        <div class="quick-actions">
            <span style="font-size: 0.85rem; color: var(--text-muted);">¿Quieres reportar o consultar una llamada sospechosa?</span>
            <a href="#notificar-telefono-sospechoso" class="qa-pill-danger">
                <span>🚨</span> Notificar número sospechoso <span>⬇</span>
            </a>
            <a href="<?php echo e(route('legal.no-molestar')); ?>" class="qa-pill-blue">
                <span>⚖️</span> PROFECO REPEP / CONDUSEF REUS ➔
            </a>
        </div>

        <!-- Banner Destacado: Bloqueador VCF -->
        <div class="vcf-promo-banner">
            <div class="vcf-promo-left">
                <span class="vcf-promo-icon">🚫</span>
                <div class="vcf-promo-text">
                    <strong>¿Harto de llamadas de cobranza, tarjetas y telemarketing?</strong>
                    <span>Bloquea cientos de números en tu celular en 1 clic con nuestra lista de contactos VCF gratuita para México.</span>
                </div>
            </div>
            <a href="<?php echo e(route('vcf.index')); ?>" class="vcf-promo-btn">
                Ver Lista VCF ➔
            </a>
        </div>
    </section>

    <!-- Pills Grid: Números Investigados -->
    <?php if($pillsPhones->isNotEmpty()): ?>
    <section style="margin-bottom: 2.5rem;">
        <div class="section-header">
            <h2>
                <span>📞</span> Teléfonos y Celulares Reportados en México
            </h2>
            <span style="font-size: 0.82rem; color: var(--text-muted); font-weight: 600;">
                <?php echo e(number_format($totalPhones)); ?> números registrados
            </span>
        </div>

        <div class="pills-grid">
            <?php $__currentLoopData = $pillsPhones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('phone.show', $p->number)); ?>" class="phone-pill <?php echo e($p->spam_score > 0 ? 'pill-danger' : 'pill-neutral'); ?>">
                    <span class="pill-number"><?php echo e($p->formatted()); ?></span>
                    <span class="pill-badge">
                        <?php echo e($p->area_code ? '📍 LADA ' . $p->area_code : '🇲🇽'); ?>

                    </span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php else: ?>
    <section style="margin-bottom: 2.5rem; text-align: center; background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 2rem 1.5rem; box-shadow: var(--shadow-sm);">
        <span style="font-size: 2.2rem; display: block; margin-bottom: 0.5rem;">🛡️</span>
        <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.5rem;">
            Directorio Libre de SPAM en Construcción Colaborativa
        </h2>
        <p style="color: var(--text-muted); font-size: 0.92rem; max-width: 540px; margin: 0 auto 1.25rem; line-height: 1.5;">
            Solo publicamos reportes y números reales aportados por la comunidad. Si recibiste una llamada sospechosa en México, búscalo arriba o notifícalo para alertar a otros usuarios.
        </p>
        <a href="<?php echo e(route('area-codes.index')); ?>" class="btn btn-outline" style="font-size: 0.88rem; padding: 0.5rem 1.2rem; display:inline-flex; align-items:center; gap:6px;">
            <span>📍</span> Ver Directorio de Claves LADA IFT ➔
        </a>
    </section>
    <?php endif; ?>

    <!-- Guía de Estafas Frecuentes en México -->
    <section style="background:linear-gradient(135deg, #1e293b, #0f172a); color:white; border-radius:var(--radius-lg); padding:2rem; margin-bottom:3rem; box-shadow:var(--shadow-hover)">
        <h2 style="font-size:1.45rem; font-weight:800; margin-bottom:0.6rem">
            🛡️ Radar de Extorsión y Fraudes Telefónicos en México
        </h2>
        <p style="color:#94a3b8; font-size:0.92rem; line-height:1.6; margin-bottom:1.5rem">
            Consejos de seguridad fundamentales para protegerte ante las modalidades de engaño más habituales:
        </p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(230px, 1fr)); gap:1rem">
            <div style="background:rgba(255, 255, 255, 0.05); border:1px solid rgba(255, 255, 255, 0.1); border-radius:var(--radius); padding:1rem">
                <strong style="color:white; display:block; font-size:0.95rem; margin-bottom:0.3rem">🚨 Falsa Extorsión / Secuestro Virtual</strong>
                <p style="color:#cbd5e1; font-size:0.84rem; margin:0; line-height:1.5">Amenazas agresivas o voces fingiendo ser familiares en apuros exigiendo depósitos en tiendas de conveniencia. Cuelga de inmediato y denuncia al 089.</p>
            </div>
            <div style="background:rgba(255, 255, 255, 0.05); border:1px solid rgba(255, 255, 255, 0.1); border-radius:var(--radius); padding:1rem">
                <strong style="color:white; display:block; font-size:0.95rem; margin-bottom:0.3rem">🏦 Falsos Cargos no Reconocidos</strong>
                <p style="color:#cbd5e1; font-size:0.84rem; margin:0; line-height:1.5">Se hacen pasar por BBVA, Santander o Banorte alertando de seguros o compras en Amazon para pedirte tu NIP o token móvil. Ningún banco pide contraseñas.</p>
            </div>
            <div style="background:rgba(255, 255, 255, 0.05); border:1px solid rgba(255, 255, 255, 0.1); border-radius:var(--radius); padding:1rem">
                <strong style="color:white; display:block; font-size:0.95rem; margin-bottom:0.3rem">💬 Robo de Cuenta de WhatsApp</strong>
                <p style="color:#cbd5e1; font-size:0.84rem; margin:0; line-height:1.5">Llaman con pretextos de paquetería (DHL, Estafeta) para que les dictes un código de 6 dígitos que llegó por SMS. Jamás compartas ese código.</p>
            </div>
        </div>
    </section>

    <!-- FAQs Schema.org -->
    <section class="faqs" itemscope itemtype="https://schema.org/FAQPage">
        <h3>Preguntas Frecuentes</h3>
        
        <details itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <summary itemprop="name">¿Qué debo hacer si recibo una llamada de extorsión telefónica en México?</summary>
            <div class="faq-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Mantén la calma, no proporciones ningún dato personal ni realices ningún depósito. Cuelga la llamada de inmediato, verifica el estado de tus familiares y realiza la denuncia anónima al <strong>089</strong> o a la Guardia Nacional y Policía Cibernética al <strong>088</strong>.</p>
            </div>
        </details>
        
        <details itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <summary itemprop="name">¿Cómo inscribir mi celular en el REPEP de PROFECO para evitar llamadas de publicidad?</summary>
            <div class="faq-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Puedes registrar tus números fijos y celulares de forma gratuita en el portal oficial del REPEP (repep.profeco.gob.mx) o llamando al 9628 0000 para CDMX o al 800 962 8000 para el resto de la República. Las empresas tienen 30 días para dejar de llamarte bajo riesgo de sanciones severas.</p>
            </div>
        </details>

        <details itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <summary itemprop="name">¿Cómo denunciar el acoso o cobranza abusiva de despachos y bancos?</summary>
            <div class="faq-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <p itemprop="text">Inscríbete en el Registro Público de Usuarios (REUS) de la CONDUSEF a través de condusef.gob.mx o llamando al 800 999 8080. Además, puedes presentar una queja formal ante el REDECO si los despachos incurren en amenazas, malos tratos o cobranzas a terceros ajenos a la deuda.</p>
            </div>
        </details>
    </section>

    <!-- Report CTA Form Section -->
    <section class="report-cta-section" id="notificar-telefono-sospechoso" style="scroll-margin-top: 5rem;">
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <span style="font-size: 2rem;">🚨</span>
            <h2 style="font-size: 1.4rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.35rem;">
                Notificar un Teléfono Sospechoso
            </h2>
            <p style="font-size: 0.92rem; color: var(--text-muted);">
                Ingresa el número que te llamó para buscar su ficha o crearla automáticamente y advertir a otros usuarios en México.
            </p>
        </div>

        <div style="max-width: 500px; margin: 0 auto;">
            <form action="<?php echo e(route('search')); ?>" method="GET" style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <input type="tel" name="q" placeholder="Número sospechoso a 10 dígitos (ej: 55 1234 5678)" required style="flex: 1; padding: 0.75rem 1rem; border: 1px solid var(--border); border-radius: var(--radius); font-size: 1rem; min-width: 200px;">
                <button type="submit" class="btn btn-primary" style="padding: 0.75rem 1.25rem;">
                    Identificar y Reportar
                </button>
            </form>
        </div>
    </section>

    <!-- EEAT Author Card (Víctor Alonso) -->
    <div class="eeat-author-card">
        <img src="<?php echo e(asset('images/victor-alonso.webp')); ?>" alt="Víctor Alonso - Desarrollador y Especialista SEO" class="eeat-avatar">
        <div class="eeat-info">
            <h4>Revisado y verificado por Víctor Alonso</h4>
            <p>Especialista en Desarrollo Web y SEO. Creador de QuiénLlama, comprometido con la transparencia en telecomunicaciones y la protección ciudadana frente a extorsiones, fraudes y spam telefónico en México, España, Chile y Argentina.</p>
            <div class="eeat-links">
                <a href="https://victor-alonso.es" target="_blank" rel="noopener noreferrer">🌍 victor-alonso.es</a> ·
                <a href="https://www.linkedin.com/in/vialonso/" target="_blank" rel="noopener noreferrer">💼 LinkedIn</a> ·
                <a href="<?php echo e(route('legal.about')); ?>">ℹ️ Sobre el autor</a>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /media/victor/externo/webs/quienllama-mexico/resources/views/home.blade.php ENDPATH**/ ?>