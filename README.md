# 📞 QuiénLlama Argentina (`ar.quienllama.com.es`)

Plataforma comunitaria independiente de referencia en la República Argentina para la identificación de llamadas desconocidas, prevención de fraudes / estafas bancarias, descarga masiva de archivos VCF de bloqueo nativo y marco regulatorio del Registro Nacional No Llame (Ley 26.951).

---

## 🚀 Características Principales

* **Normalizador ENACOM Oficial**: Algoritmo que procesa formatos nacionales e internacionales (`+54 9`, `0`, `15`, longitudes fijas de 10 dígitos) y vincula más de 70 características interurbanas argentinas (AMBA 11, Rosario 341, Córdoba 351, La Plata 221, etc.).
* **Sistema de Bloqueo Masivo VCF**: Descarga de libretas de contactos agrupadas en un único registro virtual (`Top 50`, `Top 100`, `Top 500` y por teléfono individual) para bloqueo a nivel de módem (0% batería, 0% RAM, 100% privacidad).
* **Directorio SEO de Características**: Páginas optimizadas para cada código de área con instrucciones de marcación fija y celular nacional e internacional.
* **Seguridad y Anti-Abuso**:
  * Control de acceso a paneles administrativos restringido por IP fija.
  * Protección contra bots en telemetría y endpoints de votación.
* **SEO & Indexación Instantánea**:
  * Integración con IndexNow (Bing / Yandex).
  * Soporte para Google Indexing API.
  * Generación dinámica de `sitemap.xml` y `robots.txt` con arte ASCII.
  * Documentación completa para rastreadores de IA en `llms.txt`.
  * Etiquetas OpenGraph completas y Twitter Cards con banner oficial.
* **Telemetría Híbrida**:
  * GA4 con carga no bloqueante (`requestIdleCallback` + triggers pasivos, TBT 0ms).
  * Registro nativo local en SQLite vía `navigator.sendBeacon` (`/api/track`) inmune a adblockers.

---

## 🛠️ Stack Tecnológico

* **Framework**: Laravel 12 (PHP 8.2+)
* **Base de Datos**: SQLite (`database/database.sqlite`)
* **Servidor**: Nginx + Apache en Oracle Cloud (HestiaCP)
* **Frontend**: Blade + CSS puro sin frameworks pesados

---

## 🔐 Seguridad y Administración

* Panel de métricas: `/panel-metricas` (restringido por middleware `admin.ip`).
* Disparador IndexNow: `/api/indexnow-ping-all` (restringido por middleware `admin.ip`).
* Configuración de IPs autorizadas vía `ADMIN_ALLOWED_IPS` en `.env`.

---

© 2026 Desarrollado por [Víctor Alonso](https://victor-alonso.es)
