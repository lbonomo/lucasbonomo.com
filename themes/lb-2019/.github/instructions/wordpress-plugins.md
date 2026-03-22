# WordPress Theme Copilot Instructions (LB25)

Estas reglas aplican al tema WordPress de este repositorio.

## 1. PHP y seguridad
- Cumplir WPCS en todos los archivos PHP.
- Usar tabs para indentacion en PHP.
- Escapar output en plantillas: `esc_html()`, `esc_attr()`, `esc_url()`.
- Sanitizar cualquier input de usuario antes de usarlo.
- En formularios/acciones, usar nonces y chequeo de capacidades cuando aplique.
- Mantener compatibilidad con WordPress core; evitar patrones innecesarios de framework externo.

## 2. Arquitectura del tema
- Este repositorio es un tema, no un plugin.
- Templates principales en raiz (`header.php`, `footer.php`, `front-page.php`, etc.).
- Logica auxiliar en `inc/`.
- Registro de menus, scripts y soportes del tema en `functions.php`.
- Si existe comportamiento legacy, priorizar compatibilidad hacia atras.

## 3. CSS y assets
- Editar estilos fuente en `src/css/` y compilar a `assets/css/`.
- No escribir CSS manual directamente en archivos compilados.
- Mantener consistencia visual Dark Matter:
  - fondo oscuro,
  - acento cyan electrico,
  - componentes de alto contraste,
  - detalles tecnicos (subrayados finos, bordes 1px, glow sutil).

## 4. JavaScript frontend
- Preferir JS vanilla ligero en `src/js/main.js`.
- Mantener patrones simples:
  - toggle de menu movil por clase de estado,
  - inicializacion en `DOMContentLoaded`,
  - `IntersectionObserver` para animaciones por scroll cuando sea util.
- Compilar siempre a `assets/js/main.min.js`.

## 5. Tipografias
- Regla obligatoria del proyecto: tipografias locales en `assets/fonts`.
- No usar CDNs de fuentes externas.
- Declarar y consumir fuentes desde el tema (por ejemplo en `theme.json` o CSS del proyecto).

## 6. Documentacion y cambios
- Mantener comentarios breves y utiles, solo donde aporte claridad.
- Evitar refactors masivos si no son necesarios para el requerimiento.
- Al terminar cambios de frontend, ejecutar build para dejar `assets/` actualizado.
