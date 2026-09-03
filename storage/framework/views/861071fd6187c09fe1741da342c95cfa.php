<?php $__env->startSection('title', 'Sobre mí - Víctor Alonso | Creador de QuiénLlama'); ?>
<?php $__env->startSection('meta_description', 'Conoce a Víctor Alonso, desarrollador web, especialista SEO y creador del directorio antispam colaborativo QuiénLlama.'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .about-wrapper {
        max-width: var(--content-narrow);
        margin: 2rem auto 3.5rem;
    }

    .about-hero {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .about-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--primary);
        margin-bottom: 1.25rem;
        box-shadow: 0 10px 25px rgba(227, 0, 15, 0.2);
    }

    .about-hero h1 {
        font-size: 2.25rem;
        font-weight: 900;
        color: var(--dark);
        letter-spacing: -0.5px;
        margin-bottom: 0.35rem;
    }

    .about-hero p {
        color: var(--text-muted);
        font-size: 1.15rem;
        font-weight: 600;
    }

    .about-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2.5rem;
        box-shadow: var(--shadow-sm);
        line-height: 1.7;
        color: #334155;
    }

    .about-card h2 {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--dark);
        margin-top: 1.75rem;
        margin-bottom: 0.6rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .about-card h2:first-child {
        margin-top: 0;
    }

    .about-card ul {
        margin: 0.75rem 0 1.25rem 1.5rem;
    }

    .about-card li {
        margin-bottom: 0.5rem;
    }

    .about-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="about-wrapper" itemscope itemtype="https://schema.org/Person">
    <meta itemprop="name" content="Víctor Alonso">
    <meta itemprop="jobTitle" content="Full-Stack Developer & SEO Specialist">
    <meta itemprop="url" content="https://victor-alonso.es">

    <div class="about-hero">
        <img src="<?php echo e(asset('images/victor-alonso.webp')); ?>" alt="Víctor Alonso - Desarrollador Full-Stack y Experto SEO" class="about-avatar" itemprop="image">
        <h1>Hola, soy Víctor Alonso</h1>
        <p>Desarrollador Web & Especialista SEO</p>
    </div>

    <div class="about-card">
        <h2>🎯 Mi Misión</h2>
        <p>
            Estoy comprometido con la transparencia y la lucha contra las llamadas no deseadas, las extorsiones telefónicas y el acoso de cobranza a cualquier hora del día. Por eso creé el ecosistema <strong>QuiénLlama</strong>: para ofrecer una herramienta comunitaria, rápida y gratuita donde identificar, bloquear y reportar números de telemarketing insistente, cobradores o fraudes en México, España, Chile y Argentina.
        </p>

        <h2>🛡️ Experiencia y Compromiso Técnico (E-E-A-T)</h2>
        <p>
            Como ingeniero y desarrollador de software, mi objetivo es construir plataformas seguras, ultrarrápidas y de alto valor público. Aplico estándares estrictos en cada proyecto:
        </p>
        <ul>
            <li><strong>Arquitectura web de alto rendimiento:</strong> Optimización de Core Web Vitals (WPO) para respuestas instantáneas en dispositivos móviles y conexiones lentas.</li>
            <li><strong>Sanitización y privacidad de datos:</strong> Almacenamiento seguro, sin comercialización de información personal y anonimización de direcciones IP.</li>
            <li><strong>Estructuración semántica Schema.org:</strong> Integración de microdatos y datos estructurados para una indexación clara y veraz ante los motores de búsqueda.</li>
            <li><strong>Soporte al marco regulatorio local:</strong> Fomento activo de herramientas oficiales ciudadanas como el <strong>REPEP de PROFECO</strong>, el <strong>REUS de CONDUSEF</strong> y las normativas del IFT en México.</li>
        </ul>

        <h2>🤝 Contacto y Canales Profesionales</h2>
        <p>
            Si detectaste algún problema técnico, deseas solicitar la revisión de una ficha o quieres proponer una mejora en la plataforma, puedes utilizar nuestros canales oficiales:
        </p>

        <div class="about-badges">
            <a href="<?php echo e(route('contact.index')); ?>" class="btn btn-primary" style="padding:0.6rem 1.25rem">
                <span>✉️</span> Formulario de Contacto
            </a>
            <a href="https://victor-alonso.es" target="_blank" rel="noopener noreferrer" itemprop="sameAs" class="btn btn-outline" style="background:var(--bg)">
                🌍 victor-alonso.es
            </a>
            <a href="https://www.linkedin.com/in/vialonso/" target="_blank" rel="noopener noreferrer" itemprop="sameAs" class="btn btn-outline" style="background:#0077b5; color:white; border-color:#0077b5">
                💼 LinkedIn
            </a>
            <a href="https://github.com/vicksWalkiria" target="_blank" rel="noopener noreferrer" itemprop="sameAs" class="btn btn-outline" style="background:#24292e; color:white; border-color:#24292e">
                💻 GitHub
            </a>
        </div>
    </div>
</div>

<!-- Schema.org Person JSON-LD -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Víctor Alonso",
  "jobTitle": "Full-Stack Developer & SEO Specialist",
  "url": "https://victor-alonso.es",
  "image": "<?php echo e(asset('images/victor-alonso.webp')); ?>",
  "description": "Desarrollador web y especialista SEO, creador de la plataforma antispam comunitaria QuiénLlama.",
  "sameAs": [
    "https://victor-alonso.es",
    "https://www.linkedin.com/in/vialonso/",
    "https://github.com/vicksWalkiria"
  ]
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /media/victor/externo/webs/quienllama-mexico/resources/views/legal/about.blade.php ENDPATH**/ ?>