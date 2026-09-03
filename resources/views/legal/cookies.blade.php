@extends('layouts.app')

@section('title', 'Política de Cookies - QuiénLlama Chile')

@section('content')
<div class="content-narrow" style="padding:2rem 0; line-height:1.7; color:#334155">
    <h1 style="font-size:2rem; font-weight:900; color:var(--text-main); margin-bottom:1.5rem">Política de Cookies</h1>

    <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:2rem">
        <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-main); margin-bottom:0.5rem">¿Qué son las cookies?</h3>
        <p style="margin-bottom:1.5rem">
            Una cookie es un pequeño archivo de texto que se almacena en tu navegador cuando visitas una página web. Permite recordar información sobre tu visita, como preferencias de navegación o medidas de seguridad.
        </p>

        <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-main); margin-bottom:0.5rem">¿Qué cookies utilizamos?</h3>
        <p style="margin-bottom:1.5rem">
            QuiénLlama Chile únicamente utiliza cookies técnicas estrictamente necesarias para el funcionamiento del portal (como la gestión de sesiones de búsqueda, prevención de ataques CSRF y seguridad) y cookies de analítica anonimizada para entender el volumen de consultas en el país.
        </p>

        <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-main); margin-bottom:0.5rem">Cómo gestionar o desactivar las cookies</h3>
        <p>
            Puedes permitir, bloquear o eliminar las cookies instaladas en tu dispositivo mediante la configuración de las opciones de tu navegador (Chrome, Firefox, Safari, Edge). La desactivación de cookies técnicas podría afectar el envío de comentarios o reportes en el sitio.
        </p>
    </div>
</div>
@endsection
