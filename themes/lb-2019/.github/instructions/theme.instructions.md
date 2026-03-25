description: "Reglas especificas del tema WordPress LB19: flujo src->lb19, Sass con Grunt, Material Design Lite, theme.json, i18n y assets locales. Usar cuando se editen PHP, SCSS, CSS, JS o JSON del tema."
applyTo: "**/*.{php,scss,css,js,json}"
---

# LB19 Theme Instructions

## Contexto del proyecto
- Este repositorio es un tema WordPress clasico llamado `lb19`, no un plugin ni un tema block-first.
- El codigo fuente editable vive en la raiz del proyecto.
- La carpeta `dist/` es la salida sincronizada/compilada actual. No editarla manualmente salvo que el usuario lo pida de forma explicita.
- Mantener compatibilidad con WordPress core, WPCS y el estilo existente del tema basado en Underscores + Material Design Lite.

## Flujo de trabajo real
- Editar PHP, JSON, imagenes y recursos en la raiz del proyecto.
- Editar estilos fuente en `assets/` y el entry principal en `style.css`.
- La salida compilada y sincronizada termina en `dist/`.
- `npm run dev` ejecuta Vite para desarrollo.
- `npm run build` compila assets y sincroniza archivos estaticos del tema hacia `dist/`.
- Si cambias frontend o templates, reflejarlo ejecutando el build.

## Arquitectura del tema
- `functions.php` concentra setup del tema, menus, enqueue de assets, soporte base e includes de `inc/`.
- `template-parts/` contiene los parciales reutilizables; preferir `get_template_part()` para variaciones de contenido.
- `page-templates/` contiene templates de pagina especificos.
- `inc/` aloja comportamiento transversal como navegacion, customizer, WooCommerce y estilos dinamicos.
- `acf-json/` almacena definiciones exportadas de ACF; si se tocan campos o tipos relacionados con ACF, mantener esos JSON sincronizados.

## Frontend y estilo visual
- El frontend usa clases y componentes de Material Design Lite (`mdl-*`). Preservar esa base antes de introducir nuevos patrones visuales.
- La estructura del header usa `mdl-layout`, drawer lateral, ribbon y parciales de logo/menu. Mantener consistencia con ese layout.
- Los estilos estan organizados por parciales Sass importados desde `style.scss` (`normalize`, `material`, `header`, `footer`, `woocommerce`, `mercadopago`, `core/buttons`). Si agregas una seccion nueva, integrala al entrypoint principal en lugar de crear CSS suelto fuera del flujo.
- Evitar frameworks o toolchains nuevos para interacciones simples; el stack actual es WordPress + Sass + JS vanilla + MDL.

## Tipografias y assets locales
- Toda tipografia usada por el proyecto debe vivir en `assets/fonts/` y terminar disponible en `dist/assets/fonts/` tras el build.
- No agregar nuevas fuentes ni icon fonts desde CDNs o servicios remotos.
- Si se modifica tipografia existente, migrar el consumo a archivos locales del tema en lugar de replicar el patron legacy de Google Fonts.
- Reutilizar `assets/images/` para logos, favicones e imagenes del tema.

## JavaScript
- Mantener JS liviano y en vanilla JS.
- Seguir el estilo actual del proyecto al tocar archivos existentes; si agregas logica nueva, inicializarla de forma explicita y defensiva cuando el DOM requerido exista.
- No introducir dependencias de framework para resolver mejoras pequenas de UI.
- Considerar que `customizer.js` y `palette.js` son para el Customizer/editor, mientras que `lb19.js` resuelve comportamiento del frontend publico.

## theme.json y customizer
- `theme.json` define paleta, spacing y estilos del editor/bloques. Si cambias colores o spacing global, mantener coherencia entre `theme.json`, Sass y cualquier CSS dinamico generado por el tema.
- El tema tambien inyecta variables y reglas desde `inc/style-custom.php` usando valores del Customizer (`mdl-color-primary`, `mdl-color-secondary`). Si tocas la capa visual global, revisar ambos lados: `theme.json` y customizer.
- No asumir que `theme.json` controla todo el frontend; en este tema la mayor parte del estilo sigue viviendo en Sass y templates clasicos.

## PHP, templates e i18n
- Usar el text domain `lb19` en cadenas traducibles.
- Mantener las traducciones en `languages/`.
- En templates, dejar la logica compleja en `functions.php` o `inc/` y mantener los parciales enfocados en markup.
- Al construir URLs, atributos o texto dinamico, escapar correctamente con funciones WordPress (`esc_url()`, `esc_attr()`, `esc_html()`, etc.).
- Si lees datos de `$_SERVER`, `$_GET`, `$_POST` u otras entradas, sanitizar antes de usar.

## Navegacion, contenido y CPTs
- El menu principal se renderiza manualmente en `template-parts/menu-primary.php`; si se cambia su comportamiento, preservar el calculo del estado activo y el uso de menus registrados en WordPress.
- Existen templates y parciales especificos para tipos de contenido como `proyecto`, `trabajo` y `product`; respetar esa separacion al extender funcionalidades.
- Para home, archive y single, preferir continuar el patron actual de archivos dedicados mas parciales de `template-parts/`.

## WooCommerce
- Si el cambio toca tienda o producto, revisar tambien `inc/woocommerce.php` y los parciales Sass relacionados (`woocommerce.scss`, `mercadopago.scss`).
- Mantener las personalizaciones del tema sobre WooCommerce sin reactivar estilos por defecto del plugin salvo que el cambio lo requiera explicitamente.

## Alcance de cambios
- Hacer cambios minimos y consistentes con la base existente; no reescribir el tema hacia otro sistema visual o arquitectura salvo pedido explicito.
- Antes de proponer una modernizacion amplia, comprobar primero si puede resolverse dentro del flujo actual raiz -> Vite -> `dist/`.
