# Tailwind Architecture for LB25

Aplicar Tailwind en la estructura real del tema WordPress, no en convenciones de Laravel/Blade.

## Estructura de archivos
- Fuente de estilos: `src/css/`.
- Salida compilada: `assets/css/`.
- Entry principal: `src/css/style.css`.
- Script fuente: `src/js/main.js`.
- Script compilado: `assets/js/main.min.js`.

## Regla de trabajo
- Editar siempre en `src/`.
- Nunca editar manualmente archivos compilados en `assets/`.
- Despues de cambios en CSS/JS, ejecutar build:
  - `npm run build:css:style` para estilos principales.
  - `npm run build:js` para JS.
  - `npm run build` para todo.

## HTML limpio y clases semanticas
- Evitar cadenas largas de utilidades Tailwind en PHP/HTML.
- Preferir clases semanticas por componente (ejemplo: `.header-nav`, `.brand-link`, `.btn-electric`).
- Reservar utilidades inline solo para casos muy puntuales.

## Uso de @apply
- Usar `@apply` cuando simplifique componentes repetidos.
- Si una animacion o efecto no encaja bien con utilidades, usar CSS nativo.
- Mantener reglas de estado (`:hover`, `:focus-visible`, `.is-open`) junto al componente.

## Convenciones por componente
- Encabezado y navegacion en `src/css/header.css`.
- Secciones generales en `src/css/sections.css`.
- Estilos de bloques en `src/css/blocks/*.css`.
- Mantener naming consistente, orientado a dominio del componente.

## Responsive y accesibilidad
- Diseñar mobile-first y luego escalar a desktop.
- Estados de foco visibles y contraste alto.
- Evitar depender solo de color para estados activos.

## Criterios de revision
- No introducir estilos que rompan la estetica Dark Matter.
- Verificar que el build genere `assets/css/style.css` sin errores.
- Verificar que interacciones JS sigan funcionando con las nuevas clases.