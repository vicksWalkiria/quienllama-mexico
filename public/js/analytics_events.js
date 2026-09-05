/**
 * QuiénLlama Chile - GA4 Event & Conversion Tracking Suite
 * Medición de objetivos clave, descargas VCF antispam, denuncias comunitarias, clics E-E-A-T y búsquedas.
 * Soporta medición híbrida (Google Analytics 4 + SQLite sendBeacon backend).
 */
(function() {
    'use strict';

    // Función global accesible desde cualquier script o vista Blade
    window.trackGoal = function(eventName, params) {
        if (typeof params === 'string') {
            params = { event_label: params };
        }
        params = params || {};
        params.transport_type = 'beacon';
        params.event_category = params.event_category || 'antispam_goals';

        // 1. Google Analytics 4
        try {
            if (typeof window.gtag === 'function') {
                window.gtag('event', eventName, params);
            } else if (window.dataLayer && Array.isArray(window.dataLayer)) {
                window.dataLayer.push(Object.assign({ event: eventName }, params));
            }
        } catch (err) {
            console.warn('GA4 error:', err);
        }

        // 2. Telemetría Interna SQLite vía sendBeacon / Fetch keepalive
        try {
            var payload = JSON.stringify({
                event: eventName,
                label: params.event_label || params.phone_number || params.pack || params.query || ''
            });

            if (navigator.sendBeacon) {
                navigator.sendBeacon('/api/track', new Blob([payload], { type: 'application/json' }));
            } else if (typeof fetch === 'function') {
                fetch('/api/track', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: payload,
                    keepalive: true
                }).catch(function() {});
            }
        } catch (err) {
            // Silencioso para el usuario
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        // Delegación de clics global
        document.addEventListener('click', function(e) {
            // 1. Descarga masiva de packs VCF antispam (Top 50, Top 100, Top 500)
            var packLink = e.target.closest('a[href*="/vcf/descargar/"]');
            if (packLink) {
                var packHref = packLink.getAttribute('href') || '';
                var packName = packHref.split('/').pop() || 'pack';
                window.trackGoal('vcf_download_pack', {
                    pack: packName,
                    event_label: packName,
                    page_location: window.location.pathname
                });
                return;
            }

            // 2. Descarga individual de tarjeta VCF para bloquear
            var vcfSingle = e.target.closest('a[href*=".vcf"], a[href*="/vcf"]');
            if (vcfSingle && !vcfSingle.getAttribute('href').includes('/vcf/descargar/')) {
                var href = vcfSingle.getAttribute('href') || '';
                var phoneMatch = href.match(/(\d{8,11})/);
                var num = phoneMatch ? phoneMatch[1] : '';
                window.trackGoal('download_vcf_single', {
                    phone_number: num,
                    event_label: num,
                    page_location: window.location.pathname
                });
                return;
            }

            // 3. Clics hacia Sedes Oficiales de Chile (SERNAC No Molestar, SUBTEL, ClaveÚnica)
            var officialLink = e.target.closest('a[href*="sernac.cl"], a[href*="subtel.gob.cl"], a[href*="claveunica.gob.cl"]');
            if (officialLink) {
                window.trackGoal('official_sernac_click', {
                    destination_url: officialLink.getAttribute('href') || '',
                    link_text: officialLink.textContent.trim(),
                    event_label: officialLink.getAttribute('href') || '',
                    page_location: window.location.pathname
                });
                return;
            }

            // 4. Clics en Perfil de Autor E-E-A-T (Víctor Alonso)
            var authorLink = e.target.closest('a[href*="sobre-mi"], a[href*="victor-alonso.es"], a[href*="linkedin.com/in/victor-alonso"], a[href*="github.com/vicksWalkiria"]');
            if (authorLink) {
                window.trackGoal('author_profile_click', {
                    destination_url: authorLink.getAttribute('href') || '',
                    link_text: authorLink.textContent.trim(),
                    event_label: authorLink.getAttribute('href') || '',
                    page_location: window.location.pathname
                });
                return;
            }

            // 5. Clics en Prefijos Telefónicos Chilenos
            var areaCard = e.target.closest('a[href*="/prefijo/"]');
            if (areaCard) {
                var areaHref = areaCard.getAttribute('href') || '';
                var codeMatch = areaHref.match(/\/prefijo\/(\d+)/);
                var areaCode = codeMatch ? codeMatch[1] : '';
                window.trackGoal('prefix_code_click', {
                    prefix_code: areaCode,
                    event_label: areaCode,
                    page_location: window.location.pathname
                });
                return;
            }

            // 6. Copiar número al portapapeles
            var copyBtn = e.target.closest('.btn-copy, [data-copy]');
            if (copyBtn) {
                var copiedNum = copyBtn.getAttribute('data-copy') || copyBtn.textContent.trim();
                window.trackGoal('copy_phone_number', {
                    phone_number: copiedNum,
                    event_label: copiedNum,
                    page_location: window.location.pathname
                });
                return;
            }

            // 7. Compartir en WhatsApp
            var waLink = e.target.closest('a[href*="api.whatsapp.com"], a[href*="wa.me"]');
            if (waLink) {
                window.trackGoal('whatsapp_share_click', {
                    event_label: 'compartir_whatsapp',
                    page_location: window.location.pathname
                });
                return;
            }

            // 8. Botones de votación rápida en encuesta comunitaria
            var pollBtn = e.target.closest('.poll-vote-btn, .vote-btn, button[name="reason"]');
            if (pollBtn) {
                var reason = pollBtn.value || pollBtn.getAttribute('data-reason') || pollBtn.textContent.trim();
                window.trackGoal('select_poll_reason', {
                    reason: reason,
                    event_label: reason,
                    page_location: window.location.pathname
                });
                return;
            }
        });

        // Formularios
        // Formulario de Búsqueda
        document.querySelectorAll('form[action*="buscar"]').forEach(function(form) {
            form.addEventListener('submit', function() {
                var input = form.querySelector('input[name="q"]');
                var queryVal = input ? input.value.trim() : '';
                if (queryVal) {
                    window.trackGoal('search_phone', {
                        query: queryVal,
                        event_label: queryVal,
                        page_location: window.location.pathname
                    });
                }
            });
        });

        // Formulario de Comentarios / Denuncia de Spam
        document.querySelectorAll('form[action*="/comentar"]').forEach(function(form) {
            form.addEventListener('submit', function() {
                var callTypeEl = form.querySelector('select[name="call_type"]');
                var callType = callTypeEl ? callTypeEl.value : 'otro';
                window.trackGoal('report_spam_phone', {
                    call_type: callType,
                    event_label: callType,
                    page_location: window.location.pathname
                });
            });
        });

        // Formulario de Contacto
        document.querySelectorAll('form[action*="/contacto"]').forEach(function(form) {
            form.addEventListener('submit', function() {
                window.trackGoal('contact_form_submit', {
                    event_label: 'contacto_enviado',
                    page_location: window.location.pathname
                });
            });
        });
    });
})();
