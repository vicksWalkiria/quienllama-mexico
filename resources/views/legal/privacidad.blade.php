@extends('layouts.app')

@section('title', 'Política de Privacidad - QuiénLlama Chile')

@section('content')
<div class="content-narrow" style="padding:2rem 0; line-height:1.7; color:#334155">
    <h1 style="font-size:2rem; font-weight:900; color:var(--text-main); margin-bottom:1.5rem">Política de Privacidad</h1>

    <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:2rem">
        <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-main); margin-bottom:0.5rem">1. Marco Legal (Ley N° 19.628)</h3>
        <p style="margin-bottom:1.5rem">
            En cumplimiento de la <strong>Ley N° 19.628 sobre Protección de la Vida Privada</strong> de la República de Chile, QuiénLlama Chile informa que opera como un directorio colaborativo público destinado a la identificación comunitaria de llamadas telefónicas comerciales y prevención de estafas.
        </p>

        <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-main); margin-bottom:0.5rem">2. Datos Recopilados</h3>
        <p style="margin-bottom:1.5rem">
            No requerimos registro de usuarios ni recopilamos datos sensibles de los visitantes. Los comentarios y valoraciones aportados por los usuarios se publican de forma voluntaria. Para prevenir abusos y ataques de denegación de servicio, se almacena una representación hash anonimizada e irreversible (SHA-256) de la dirección IP de conexión.
        </p>

        <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-main); margin-bottom:0.5rem">3. Finalidad del Tratamiento</h3>
        <p style="margin-bottom:1.5rem">
            La información aportada por la comunidad tiene como único fin alertar a otros ciudadanos sobre prácticas de acoso telefónico, publicidad no deseada, estafas virtuales y cumplimiento de la plataforma <strong>No Molestar del SERNAC (Ley N° 19.496)</strong>.
        </p>

        <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-main); margin-bottom:0.5rem">4. Ejercicio de Derechos y Baja de Contenido</h3>
        <p>
            Cualquier particular que considere que un comentario vulnera su intimidad o contiene datos erróneos puede solicitar la moderación o eliminación del mismo a través de nuestro formulario de contacto.
        </p>
    </div>
</div>
@endsection
