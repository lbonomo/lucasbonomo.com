# CSS Class Consolidation Plan

Reducir la cantidad de class names específicas por tipo de contenido en el tema LB19, extrayendo una base compartida para cards, badges/tags y CTAs reutilizable entre blog, proyectos y, en menor medida, trabajos.

La recomendación es hacer la consolidación en dos capas: primero una base común no disruptiva en CSS, luego migrar templates de archive y single a esa base manteniendo variantes mínimas por contenido donde la estructura realmente diverge.

## Steps

1. Fase 1, auditoría de contratos visuales: listar qué selectores hoy actúan como contrato en archive y single para post, proyecto y trabajo, y separar reglas verdaderamente compartidas de reglas específicas de layout. Esto toma como referencia las clases actuales en cards, taxonomías, títulos, media wrappers y CTAs. Este paso bloquea los siguientes.
2. Fase 2, diseñar nomenclatura compartida: definir una convención corta y consistente para clases reutilizables, por ejemplo una familia base de card, elementos internos de card, badge/tag y CTA, con modificadores solo cuando cambie el layout. La recomendación es no migrar a una metodología completa nueva si no aporta valor; basta con una convención simple y estable. Esto depende del paso 1.
3. Fase 3, extraer estilos comunes a una capa compartida: mover a assets/css/style.css o a un parcial compartido importado desde allí las reglas repetidas de borde, fondo, sombra, spacing, tipografía de título, pills y botón de acción. Mantener en assets/css/posts.css, assets/css/proyectos.css y assets/css/trabajos.css solo las variantes de layout y comportamiento específicas. Esto depende del paso 2.
4. Fase 4, migrar archive cards de blog y proyectos: actualizar template-parts/content-post.php y template-parts/content-proyecto.php para reemplazar class names específicas por la base compartida y dejar modificadores mínimos por tipo de card cuando sea necesario. Unificar badges de categorías, tags y características, y usar una sola clase de CTA en ambos templates. Esto depende del paso 3.
5. Fase 5, migrar single views: actualizar template-parts/content-single-post.php y template-parts/content-single-proyecto.php para reutilizar la misma clase compartida de badges/tags y, cuando aplique, la misma base de contenedor/card. Mantener diferencias funcionales como metadata o thumbnail enlazado solo como variantes. Esto puede avanzar en paralelo con el paso 6 una vez completado el paso 3.
6. Fase 6, integrar trabajos como variante acotada: revisar template-parts/content-trabajo.php y assets/css/trabajos.css para conectar trabajo a la misma base de contenedor o título donde sea compatible, sin forzar que adopte exactamente la misma estructura de card que blog/proyectos. La recomendación es reutilizar tokens y subcomponentes compartidos, no reescribir el grid editorial especial de trabajos. Esto puede avanzar en paralelo con el paso 5 una vez completado el paso 3.
7. Fase 7, alinear contenedores de archive: evaluar si archive.php y archive-proyecto.php pueden compartir una clase contenedora común con modificadores de columnas o densidad, manteniendo intacto el sentinel de infinite scroll. Solo consolidar aquí si mejora la legibilidad sin mezclar dos layouts que aún necesitan comportamientos diferentes. Esto depende del paso 4.
8. Fase 8, limpieza y compatibilidad: dejar aliases temporales o migrar selectores de forma coordinada para evitar regresiones mientras existan templates viejos o contenido cargado por AJAX. Verificar que get_template_part() y lb19_ajax_load_more_posts() sigan devolviendo markup compatible con el CSS final. Esto depende de los pasos 4, 5 y 6.
9. Fase 9, build y validación: compilar assets con npm run build y validar visualmente archives y singles de post/proyecto, además del grid de trabajos y el infinite scroll. Esto depende de todos los pasos anteriores.

## Relevant Files

- assets/css/style.css: punto natural para alojar la capa compartida; ya contiene una clase reutilizable de pills y centraliza imports.
- assets/css/posts.css: fuente actual de la familia post-card y post-single; sirve para separar qué queda como variante y qué sube a la base compartida.
- assets/css/proyectos.css: contiene proyecto-card y proyecto-single con mucha superposición respecto de posts; principal candidato a consolidación.
- assets/css/trabajos.css: variante editorial distinta; conviene reutilizar tokens/subcomponentes sin perder su grid particular.
- assets/css/buttons-cta.css: origen actual de la clase cta; debe converger con el enlace de acción de post cards.
- template-parts/content-post.php: card de archive/listado para posts; hoy usa post-card, card-pill y post-card-link.
- template-parts/content-proyecto.php: card de archive/listado para proyectos; hoy usa proyecto-card, proyecto-card-pill y cta.
- template-parts/content-single-post.php: single de post; reutilizable para unificar pills/tags y contenedor.
- template-parts/content-single-proyecto.php: single de proyecto; reutilizable para unificar tags y contenedor base.
- template-parts/content-trabajo.php: markup base de trabajos; permite detectar qué elementos conviene acoplar a la nueva capa común.
- archive.php: archive genérico de posts; candidato a una clase contenedora compartida.
- archive-proyecto.php: archive de proyectos; hoy usa archive-grid y sirve para definir la estrategia de layout compartido.
- functions.php: lb19_infinite_scroll_sentinel() y lb19_ajax_load_more_posts() condicionan que la migración de templates no rompa el append por AJAX.

## Verification

1. Revisar visualmente archive de posts para confirmar que card, badge y CTA mantienen jerarquía, spacing y responsive.
2. Revisar visualmente archive de proyectos para confirmar que la media, tags y footer siguen alineados tras la migración a clases compartidas.
3. Revisar single de post y single de proyecto para verificar que las pills/tags se renderizan con la nueva clase común sin pérdida de estilos.
4. Revisar la grilla de trabajos, incluida la variante first-page, para confirmar que la base compartida no rompe el layout editorial especial.
5. Validar infinite scroll en archives para asegurar que el markup cargado por lb19_ajax_load_more_posts() se integra con los nuevos selectores.
6. Ejecutar npm run build para regenerar y sincronizar la salida del tema hacia dist/.
7. Si hay herramientas disponibles en el entorno, correr chequeos de lint/errores sobre los archivos tocados, especialmente templates PHP y CSS procesado por Vite/PostCSS.

## Decisions

- Incluido en alcance: archives de blog y proyectos, single views de post y proyecto, y reutilización parcial en trabajos.
- Excluido por ahora: una reescritura completa del sistema visual, cambios en MDL, cambios de theme.json o adopción de un framework o metodología nueva solo para nombres de clases.
- Recomendación clave: consolidar primero subcomponentes compartidos como badge, CTA, contenedor base y título antes de intentar unificar todos los wrappers/layouts.
- Recomendación clave: mantener aliases temporales o una migración en bloque; no conviene dejar mitad del markup viejo conviviendo con CSS ya depurado sin compatibilidad.

## Further Considerations

1. Conviene decidir temprano si la clase compartida principal será semántica y neutral o si se mantendrán nombres por dominio con una capa alias temporal; la opción recomendada es una clase neutral y corta para reducir deuda futura.
2. En trabajos, lo más seguro es reutilizar tipografía, bordes y spacing antes que intentar forzar exactamente la misma anatomía de card que posts/proyectos.
3. Si el objetivo incluye reducir tamaño de CSS final además de nombres, conviene medir después del build cuántas reglas viejas quedaron obsoletas para eliminarlas en una segunda pasada controlada.