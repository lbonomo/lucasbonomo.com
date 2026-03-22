# UI and Design Standards (LB25)

Mantener una direccion visual consistente con Dark Matter: interfaz oscura, tecnica y minimalista, con acentos electricos y animaciones discretas.

## Alcance
- Aplicar estas reglas en plantillas PHP, estilos y JS de frontend.
- Priorizar coherencia visual antes que experimentar con nuevas paletas o patrones.

## Tokens visuales obligatorios
- Fondo base: `#0A0A0A` (void) y `#0D0F1A` (deep navy).
- Superficies: `#111420`.
- Acento principal: `#4AF0F0` (electric).
- Texto principal: `#E8E8EC`.
- Texto secundario: `#A8A8A8`.
- Borde sutil: `rgba(74, 240, 240, 0.15)`.

## Tipografia
- Toda tipografia debe vivir en `assets/fonts` y cargarse desde archivos locales.
- Evitar CDNs de fuentes externas.
- Para branding tecnico, preferir familia monoespaciada (por ejemplo JetBrains Mono local o fallback monospace).

## Header y navbar
- Header sticky/fixed con blur sutil y borde inferior en acento electrico.
- Link activo/hover en navegacion con subrayado fino.
- CTA final de menu con borde de 1px y hover invertido (fondo electric, texto oscuro).
- El branding del logo debe usar cursor animado (`.logo-cursor`) y texto uppercase con tracking amplio.

## Botones
- Bordes rectos o radio minimo.
- Espaciado compacto, uppercase y tracking tecnico.
- Variantes minimas:
	- Primario: fondo acento + texto oscuro.
	- Secundario/outline: fondo transparente + borde acento.

## Animaciones
- Usar animaciones utiles y sobrias, evitando exceso de microinteracciones.
- Patrones recomendados:
	- Cursor blink para logo.
	- Fade-in-up en aparicion por scroll.
	- Underline progresivo en enlaces de nav.

## Capas visuales recomendadas
- Grid overlay tenue y scanlines muy suaves solo cuando aporten atmosfera.
- Evitar fondos planos sin profundidad en secciones hero.

## JS de interaccion
- JS vanilla, liviano y con inicializacion en `DOMContentLoaded`.
- Mobile menu toggle simple con clases de estado (`is-open` o `hidden`).
- Si hay smooth scroll con anclas, compensar altura de header sticky.
- Usar `IntersectionObserver` para animaciones en scroll cuando corresponda.

## Criterios de calidad
- Accesibilidad minima: `aria-label`, `aria-expanded`, foco visible.
- Performance: evitar librerias pesadas para interacciones basicas.
- Consistencia: no mezclar estilos claros o paletas ajenas al sistema Dark Matter.