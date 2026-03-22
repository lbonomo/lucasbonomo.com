---
description: "Reglas del tema LB25 para frontend Dark Matter, arquitectura de assets, tipografias locales y flujo WordPress theme-first. Usar cuando se editen PHP/CSS/JS/theme.json."
applyTo: "**/*.{php,css,js,json}"
---

# LB25 Theme Instructions

## Contexto del proyecto
- Este repositorio es un tema WordPress, no un plugin.
- Mantener compatibilidad con WordPress core y WPCS.
- Estructura real del proyecto:
  - fuente CSS en src/css
  - fuente JS en src/js
  - salida compilada en assets/css y assets/js

## Regla de tipografias
- Toda tipografia debe descargarse y almacenarse en assets/fonts.
- No usar CDNs para fuentes.
- Consumir fuentes desde archivos locales del tema (CSS o theme.json).

## Flujo de edicion
- Editar siempre en src.
- No editar manualmente archivos compilados de assets.
- Tras cambios de frontend, ejecutar build para mantener assets al dia:
  - npm run build:css:style
  - npm run build:js
  - npm run build

## Sistema visual
- Fondo principal oscuro (#0A0A0A / #0D0F1A).
- Acento electrico cyan (#4AF0F0).
- Bordes de 1px y contraste alto.
- Estilo tecnico/minimalista con animaciones sobrias.

## Header y navegacion
- Header sticky/fixed con borde inferior sutil y blur.
- Navegacion con estado activo y hover claros.
- Ultimo item de menu como CTA outline.
- Branding de logo con cursor animado y texto uppercase tracking amplio.

## JavaScript de interaccion
- JS vanilla liviano.
- Inicializacion en DOMContentLoaded.
- Toggle de menu movil por clases de estado.
- Usar IntersectionObserver para animaciones de scroll cuando aplique.

## theme.json y botones
- Definir variantes de botones de core/button desde theme.json.
- Mantener al menos variantes primaria y secundaria/outline.
- Conservar coherencia con la paleta Dark Matter.

## Seguridad y calidad
- Escapar output en templates: esc_html, esc_attr, esc_url.
- Sanitizar entradas antes de usar.
- Evitar cambios masivos no solicitados.
- Priorizar accesibilidad minima: aria-label, aria-expanded, foco visible.
