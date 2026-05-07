# AGENTS.md

Guia de contexto para agentes y colaboradores que trabajen en este proyecto.

## Proyecto

**Welcome Popup Manager** es un plugin para WordPress que permite administrar y mostrar un popup de bienvenida configurable en el frontend del sitio.

Desde el panel de administracion se puede:

- Activar o desactivar el popup.
- Definir una descripcion.
- Seleccionar una imagen usando la Media Library de WordPress.
- Asociar un enlace a la imagen.
- Configurar un retraso de aparicion.
- Elegir la frecuencia de visualizacion mediante reglas de modo automatico o modo manual basado en cookies.

Stack principal:

- PHP
- WordPress Plugin API
- JavaScript
- jQuery
- HTML
- CSS

APIs y funciones de WordPress usadas con frecuencia:

- `add_action`
- `add_menu_page`
- `register_setting`
- `add_settings_section`
- `add_settings_field`
- `settings_fields`
- `do_settings_sections`
- `submit_button`
- `wp_enqueue_script`
- `wp_enqueue_style`
- `wp_enqueue_media`
- `wp.media`
- `get_option`
- `wp_parse_args`
- `sanitize_textarea_field`
- `esc_url_raw`
- `esc_html`
- `esc_attr`
- `esc_url`

## Arquitectura

El plugin esta organizado por responsabilidades. Mantener esta separacion es una prioridad del proyecto.

```text
welcome-popup-manager/
+-- welcome-popup-manager.php
+-- bootstrap/
|   +-- admin.php
|   +-- public.php
+-- admin/
|   +-- AdminAssets.php
|   +-- AdminMenu.php
|   +-- SettingsPageController.php
|   +-- SettingsRegistry.php
|   +-- assets/
|   |   +-- admin.js
|   +-- fields/
+-- domain/
|   +-- Settings.php
|   +-- SettingsSanitizer.php
|   +-- PopupRules.php
+-- public/
|   +-- PopupRenderer.php
|   +-- assets/
|   |   +-- popup.css
|   |   +-- popup.js
|   +-- views/
|       +-- popup.php
+-- views/
    +-- admin-settings-page.php
```

### Entrada del plugin

`welcome-popup-manager.php` es el punto de entrada. Define:

- Metadata del plugin.
- Namespace base `WPM1`.
- Constantes:
  - `WPM1_PLUGIN_PATH`
  - `WPM1_PLUGIN_URL`
  - `WPM1_PLUGIN_VERSION`
- Carga de bootstrap:
  - `bootstrap/admin.php`
  - `bootstrap/public.php`

No agregar logica de negocio en este archivo. Debe permanecer como punto de entrada y coordinacion.

### Bootstrap

`bootstrap/admin.php` inicializa solo el contexto de administracion usando `is_admin()`.

Responsabilidades:

- Cargar clases de `admin/`.
- Cargar clases de dominio necesarias para settings.
- Cargar fields del formulario de settings.
- Ejecutar `AdminAssets::init()`.
- Ejecutar `SettingsPageController::init()`.

`bootstrap/public.php` inicializa el contexto publico.

Responsabilidades:

- Cargar `Settings`, `PopupRules` y `PopupRenderer`.
- Ejecutar `PopupRenderer::init()`.

### Admin

La capa `admin/` contiene solo codigo especifico del WP Admin.

Clases principales:

- `AdminMenu`: registra la pagina del menu de administracion.
- `AdminAssets`: carga assets del admin solo en `toplevel_page_welcome-popup-manager`.
- `SettingsPageController`: registra hooks `admin_menu` y `admin_init`.
- `SettingsRegistry`: registra settings, seccion y campos.
- `admin/fields/*`: renderiza cada campo del formulario de configuracion.

La vista principal del admin esta en `views/admin-settings-page.php`.

### Domain

La capa `domain/` contiene la logica de negocio y debe mantenerse lo mas independiente posible de la interfaz.

Clases principales:

- `Settings`: objeto de lectura para acceder a las opciones del plugin con defaults.
- `SettingsSanitizer`: sanitiza lo recibido desde el formulario de WordPress.
- `PopupRules`: decide si el popup puede mostrarse, si debe mostrarse y cuantos milisegundos de delay aplicar.

Reglas actuales:

- El popup solo se registra para portada o home mediante `is_front_page()` o `is_home()`.
- No se muestra si esta desactivado.
- No se muestra si no hay imagen configurada.
- En modo `manual`, no se muestra si existe la cookie `wpm_popup_shown`.
- El delay se expresa en milisegundos para JavaScript.

Nota: `PopupRules::wasAlreadyShown()` lee directamente `$_COOKIE['wpm_popup_shown']`. Es una dependencia tecnica puntual aceptada por ahora; si las reglas crecen, se puede abstraer en una capa dedicada.

### Public

La capa `public/` contiene renderizado, assets y comportamiento frontend.

Clases y archivos principales:

- `PopupRenderer`: instancia settings y reglas, registra assets y renderiza el popup en `wp_footer`.
- `public/views/popup.php`: plantilla publica del popup.
- `public/assets/popup.js`: apertura con delay, cierre por boton, click fuera del modal, tecla Escape y persistencia de cookie.
- `public/assets/popup.css`: estilos del overlay, modal, imagen, descripcion y boton de cierre.

## Flujo De Ejecucion

1. WordPress carga `welcome-popup-manager.php`.
2. Se definen constantes globales del plugin.
3. Se carga bootstrap de admin y public.
4. En admin:
   - Se registra el menu.
   - Se registra la opcion `wpm_settings`.
   - Se registran los campos de configuracion.
   - Se carga `admin/assets/admin.js` solo en la pagina del plugin.
5. En frontend:
   - `PopupRenderer::init()` obtiene `Settings::fromWp()`.
   - Se crean las reglas con `PopupRules`.
   - En el hook `wp`, se verifica si corresponde registrar assets/render.
   - En `wp_footer`, se renderiza el popup si `shouldShow()` devuelve `true`.
   - JavaScript abre el modal luego del delay y setea la cookie `wpm_popup_shown`.

## Opcion Principal

La configuracion se guarda en una unica opcion de WordPress:

```php
wpm_settings
```

Defaults actuales en `Settings::defaults()`:

```php
[
    'enabled'       => false,
    'description'   => '',
    'link'          => '',
    'image'         => '',
    'delay_enabled' => false,
    'delay_seconds' => 5,
    'display_mode'  => 'auto',
]
```

Modos de visualizacion:

- `auto`: el popup puede mostrarse segun reglas generales.
- `manual`: el popup no vuelve a mostrarse si la cookie `wpm_popup_shown` ya existe.

## Convenciones De Codigo

- Usar namespace `WPM1` y subnamespaces existentes:
  - `WPM1\Admin`
  - `WPM1\Admin\Fields`
  - `WPM1\Domain`
  - `WPM1\PublicSite`
  - `WPM1\Bootstrap`
- Mantener `if (!defined('ABSPATH')) { exit; }` en archivos PHP cargables por WordPress.
- Preferir clases pequenas con responsabilidad clara.
- No mezclar renderizado HTML con logica de negocio.
- No agregar logica de admin en `domain/` ni logica frontend en `admin/`.
- Usar constantes del plugin para rutas y URLs.
- Como no hay autoload configurado, agregar nuevos `require_once` en el bootstrap correspondiente.
- Mantener los handles de assets con prefijo `wpm-`.
- Mantener nombres de opciones y campos dentro de `wpm_settings[...]`.

## Seguridad WordPress

Al modificar el plugin, cuidar especialmente:

- Sanitizar toda entrada en `SettingsSanitizer`.
- Escapar toda salida en vistas:
  - `esc_html()` para texto.
  - `esc_attr()` para atributos.
  - `esc_url()` para URLs.
- Usar `esc_url_raw()` para guardar URLs.
- Usar `absint()` para numeros enteros positivos.
- Restringir valores enumerados con allowlist, como `display_mode`.
- Cargar assets de admin condicionalmente solo en la pantalla del plugin.
- No confiar en `$_POST`, `$_GET` o `$_COOKIE` sin validacion o una regla explicita.

## Como Agregar Un Nuevo Setting

Para agregar una nueva opcion configurable:

1. Agregar el default en `domain/Settings.php`.
2. Agregar un getter de lectura en `Settings`.
3. Sanitizar el valor en `domain/SettingsSanitizer.php`.
4. Crear un field en `admin/fields/`.
5. Cargar el field en `bootstrap/admin.php`.
6. Registrar el field en `admin/SettingsRegistry.php`.
7. Usar el valor desde la capa correspondiente:
   - Reglas: `domain/PopupRules.php`.
   - Render publico: `public/PopupRenderer.php` y `public/views/popup.php`.
   - UI admin: field especifico o `admin/assets/admin.js`.

## Comportamiento Frontend

El popup se controla con `public/assets/popup.js`.

Comportamientos actuales:

- Espera a `DOMContentLoaded`.
- Busca `#wpm-overlay` y `.wpm-modal`.
- Lee `data-delay` desde el modal.
- Abre el popup con `setTimeout`.
- Agrega `wpm-modal-open` al `body`.
- Setea la cookie `wpm_popup_shown=1; path=/`.
- Cierra por:
  - Boton `.wpm-close`.
  - Click en overlay.
  - Tecla `Escape`.
- Evita cerrar cuando el click ocurre dentro del modal.

Si se cambia la politica de frecuencia, revisar en conjunto:

- `domain/PopupRules.php`
- `public/assets/popup.js`
- La cookie `wpm_popup_shown`

## Verificacion Recomendada

Despues de cambios en PHP:

```bash
php -l welcome-popup-manager.php
php -l bootstrap/admin.php
php -l bootstrap/public.php
php -l admin/SettingsRegistry.php
php -l public/PopupRenderer.php
php -l domain/Settings.php
php -l domain/SettingsSanitizer.php
php -l domain/PopupRules.php
```

Despues de cambios funcionales, probar manualmente en WordPress:

- Activar/desactivar popup desde WP Admin.
- Seleccionar imagen con Media Library.
- Guardar descripcion y link.
- Probar delay activado y desactivado.
- Probar modo `auto`.
- Probar modo `manual` borrando y creando la cookie `wpm_popup_shown`.
- Confirmar que el popup solo aparece en home/front page.
- Confirmar cierre por boton, overlay y Escape.

## Notas Para LinkedIn/CV

Resumen breve del proyecto:

Desarrolle **Welcome Popup Manager**, un plugin personalizado para WordPress que permite crear y administrar popups de bienvenida configurables desde el panel de administracion. Implemente una arquitectura modular separando logica de negocio, administracion, renderizado publico y bootstrap del plugin. El sistema incluye carga condicional de assets, integracion con la Media Library de WordPress, sanitizacion de opciones, reglas de visualizacion, delay configurable y control de frecuencia mediante cookies.

Stack:

- PHP
- WordPress Plugin API
- JavaScript
- jQuery
- HTML
- CSS

Enfoque:

- Desarrollo de plugins WordPress.
- Arquitectura modular.
- Buenas practicas de seguridad.
- Separacion de responsabilidades.
- Experiencia configurable desde WP Admin.

## Principios Para Futuras Modificaciones

- Mantener el plugin simple y modular.
- Preferir cambios pequenos y faciles de revisar.
- Respetar la estructura existente antes de introducir abstracciones nuevas.
- Si una regla pertenece al negocio, ubicarla en `domain/`.
- Si algo solo existe para el admin, ubicarlo en `admin/`.
- Si algo solo existe para el frontend, ubicarlo en `public/`.
- Si una plantilla imprime HTML, asegurar escapes de salida.
- Si se agrega una dependencia tecnica nueva, documentar por que es necesaria.
