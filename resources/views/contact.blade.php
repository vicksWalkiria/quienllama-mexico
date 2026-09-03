@extends('layouts.app')

@section('title', 'Contacto y Soporte - QuiénLlama México')
@section('meta_description', '¿Tienes alguna consulta, error que reportar o sugerencia para QuiénLlama México? Contáctanos a través de nuestro formulario oficial.')

@section('styles')
<style>
    .contact-wrapper {
        max-width: var(--content-narrow);
        margin: 1.5rem auto 3rem;
    }

    .contact-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2.25rem;
        box-shadow: var(--shadow);
    }

    .contact-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .contact-icon-badge {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .contact-header h1 {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .contact-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--text-main);
        margin-bottom: 0.4rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.95rem;
        background: var(--bg);
        outline: none;
        transition: all 0.2s;
    }

    .form-control:focus {
        background: white;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(227, 0, 15, 0.12);
    }

    .form-help {
        font-size: 0.78rem;
        color: var(--text-muted);
        display: block;
        margin-top: 0.35rem;
    }
</style>
@endsection

@section('content')
<div class="contact-wrapper">
    <div class="contact-card">
        <div class="contact-header">
            <div class="contact-icon-badge">✉️</div>
            <h1>Contacto y Soporte</h1>
            <p>
                ¿Detectaste algún problema técnico, deseas solicitar la revisión o rectificación de un número, o quieres proponernos una mejora? Envíanos tu consulta a continuación.
            </p>
        </div>

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Tu Nombre o Alias (*)</label>
                <input type="text" id="name" name="name" required placeholder="Ej: Martín Rodríguez" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Tu Correo Electrónico (*)</label>
                <input type="email" id="email" name="email" required placeholder="ejemplo@dominio.com" class="form-control" value="{{ old('email') }}">
                <span class="form-help">Solo lo utilizaremos para responder a tu consulta. No enviamos publicidad.</span>
            </div>

            <div class="form-group">
                <label for="subject" class="form-label">Motivo de la Consulta (*)</label>
                <select id="subject" name="subject" required class="form-control">
                    <option value="Reportar un fallo técnico">🐛 Reportar un fallo o error en la web</option>
                    <option value="Solicitar rectificación o retirada">🛡️ Solicitar rectificación o eliminación de número</option>
                    <option value="Propuesta de mejora">💡 Propuesta o sugerencia de mejora</option>
                    <option value="Consulta general">✉️ Consulta general / Otro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message" class="form-label">Tu Mensaje (*)</label>
                <textarea id="message" name="message" rows="5" required minlength="10" placeholder="Explica detalladamente tu consulta, adjuntando el número afectado si corresponde..." class="form-control">{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%; padding:0.9rem">
                ✉️ Enviar Mensaje
            </button>
        </form>

        <div style="margin-top:2rem; padding-top:1.5rem; border-top:1px solid var(--border); text-align:center; font-size:0.85rem; color:var(--text-muted)">
            También puedes escribir directamente a <a href="mailto:soy@victor-alonso.es" style="color:var(--primary); font-weight:700">soy@victor-alonso.es</a>
        </div>
    </div>
</div>
@endsection
