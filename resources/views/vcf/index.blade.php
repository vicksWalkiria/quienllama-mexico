@extends('layouts.app')

@section('title', 'Bloqueador Masivo de Llamadas Spam en México (.VCF) - QuiénLlama')
@section('meta_description', 'Descarga gratis la lista de contactos VCF con los números spam más activos en México. Bloquea llamadas molestas en tu celular Android o iPhone en 1 minuto.')

@section('content')
    <div class="content-tool">
        <div style="text-align:center; margin-bottom:3rem">
            <span style="font-size:3rem; display:block; margin-bottom:0.75rem">🛡️</span>
            <h1 style="font-size:2.4rem; font-weight:900; color:var(--text-main); letter-spacing:-0.5px; margin-bottom:1rem">
                Bloqueador Masivo de Spam Telefónico en México
            </h1>
            <p style="font-size:1.1rem; color:var(--text-muted); line-height:1.6">
                Descarga en tu celular una lista actualizada en formato <strong>.VCF</strong> con los teléfonos más denunciados por cobranza agresiva, telemarketing y extorsión en el país (+52), y bloquéalos a todos en 1 minuto.
            </p>
        </div>

        <!-- Download Packages Grid -->
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:1.5rem; margin-bottom:3.5rem">
            <!-- Pack 50 -->
            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:2rem; text-align:center; box-shadow:var(--shadow-sm)">
                <div style="font-size:1.1rem; font-weight:700; color:var(--text-muted); margin-bottom:0.5rem">Paquete Básico</div>
                <div style="font-size:2.5rem; font-weight:900; color:var(--text-main); margin-bottom:0.75rem">Top 50</div>
                <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.5; margin-bottom:1.5rem">
                    Los 50 números con mayores reportes activos de las últimas semanas en México.
                </p>
                <a href="{{ route('vcf.download', 'top50') }}" class="btn btn-outline" style="width:100%">
                    📥 Descargar Top 50 (.vcf)
                </a>
            </div>

            <!-- Pack 100 (Recomendado) -->
            <div style="background:white; border:2px solid var(--primary); border-radius:var(--radius-lg); padding:2rem; text-align:center; box-shadow:var(--shadow-md); position:relative">
                <span style="position:absolute; top:-12px; left:50%; transform:translateX(-50%); background:var(--primary); color:white; font-size:0.75rem; font-weight:800; text-transform:uppercase; padding:3px 12px; border-radius:9999px">
                    Recomendado
                </span>
                <div style="font-size:1.1rem; font-weight:700; color:var(--primary); margin-bottom:0.5rem">Paquete Completo</div>
                <div style="font-size:2.5rem; font-weight:900; color:var(--text-main); margin-bottom:0.75rem">Top 100</div>
                <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.5; margin-bottom:1.5rem">
                    Los 100 números más insistentes (llamadas silenciosas, telemarketing y estafas bancarias).
                </p>
                <a href="{{ route('vcf.download', 'top100') }}" class="btn btn-primary" style="width:100%">
                    🛡️ Descargar Top 100 (.vcf)
                </a>
            </div>

            <!-- Pack 500 -->
            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:2rem; text-align:center; box-shadow:var(--shadow-sm)">
                <div style="font-size:1.1rem; font-weight:700; color:var(--text-muted); margin-bottom:0.5rem">Paquete Extendido</div>
                <div style="font-size:2.5rem; font-weight:900; color:var(--text-main); margin-bottom:0.75rem">Top 500</div>
                <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.5; margin-bottom:1.5rem">
                    Cobertura profunda incluyendo números de call centers y empresas de todas las regiones de Chile.
                </p>
                <a href="{{ route('vcf.download', 'top500') }}" class="btn btn-outline" style="width:100%">
                    📥 Descargar Top 500 (.vcf)
                </a>
            </div>
        </div>

        <!-- How to Use Tutorial -->
        <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:2.5rem; box-shadow:var(--shadow-sm); margin-bottom:3.5rem">
            <h2 style="font-size:1.5rem; font-weight:800; color:var(--dark); margin-bottom:1.5rem; text-align:center">
                📖 ¿Cómo se usa este archivo en tu celular?
            </h2>

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(230px, 1fr)); gap:1.5rem">
                <div>
                    <div style="width:40px; height:40px; border-radius:50%; background:var(--primary-light); color:var(--primary); font-weight:900; display:flex; align-items:center; justify-content:center; margin-bottom:0.75rem; font-size:1.1rem">
                        1
                    </div>
                    <h3 style="font-size:1.05rem; font-weight:700; color:var(--dark); margin-bottom:0.4rem">Descarga el archivo</h3>
                    <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.5">
                        Elige cualquiera de los paquetes de arriba desde tu celular o computadora. Se descargará un archivo con extensión <code>.vcf</code>.
                    </p>
                </div>

                <div>
                    <div style="width:40px; height:40px; border-radius:50%; background:var(--primary-light); color:var(--primary); font-weight:900; display:flex; align-items:center; justify-content:center; margin-bottom:0.75rem; font-size:1.1rem">
                        2
                    </div>
                    <h3 style="font-size:1.05rem; font-weight:700; color:var(--dark); margin-bottom:0.4rem">Ábrelo en Contactos</h3>
                    <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.5">
                        Toca el archivo descargado. Tu celular (Android o iPhone) te preguntará si quieres importar los contactos a tu agenda. Acepta la importación.
                    </p>
                </div>

                <div>
                    <div style="width:40px; height:40px; border-radius:50%; background:var(--primary-light); color:var(--primary); font-weight:900; display:flex; align-items:center; justify-content:center; margin-bottom:0.75rem; font-size:1.1rem">
                        3
                    </div>
                    <h3 style="font-size:1.05rem; font-weight:700; color:var(--dark); margin-bottom:0.4rem">Bloquea el contacto</h3>
                    <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.5">
                        Se creará un contacto llamado <strong>SPAM QuienLlama</strong>. Entra en tu agenda, ábrelo y pulsa en <strong>"Bloquear contacto"</strong>. ¡Listo! Ninguno de esos números volverá a sonar.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
