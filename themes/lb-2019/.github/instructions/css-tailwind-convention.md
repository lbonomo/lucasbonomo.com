# CSS Tailwind Convention

## Descripción
Este documento establece la convención de uso de clases CSS en combinación con Tailwind CSS para mantener el código HTML limpio y legible, y facilitar el mantenimiento de estilos.

## Regla Principal
**En lugar de aplicar directamente clases de Tailwind en el HTML, se deben definir clases CSS personalizadas en archivos SCSS/CSS que utilicen la directiva `@apply` de Tailwind para agrupar las utilidades correspondientes.**

## Beneficios
- ✅ HTML más limpio y legible
- ✅ Estilos centralizados y fáciles de mantener
- ✅ Mejor reutilización de componentes
- ✅ Cambios globales más fáciles de implementar
- ✅ Separación clara entre estructura y presentación

## Ejemplo Correcto

### ❌ Incorrecto: Clases Tailwind directo en HTML
```php
<a href="<?php echo esc_url( $item->url ); ?>"
   class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium uppercase tracking-wide md:text-white md:hover:bg-white md:hover:bg-opacity-20 text-slate-700 hover:bg-slate-100 hover:text-slate-900">
    <?php echo esc_html( $item->title ); ?>
</a>
```

### ✅ Correcto: Usar clases CSS con @apply
**En HTML (template-parts/menu-primary.php):**
```php
<a href="<?php echo esc_url( $item->url ); ?>"
   class="menu-link">
    <?php echo esc_html( $item->title ); ?>
</a>
```

**En SCSS (assets/sass/header.scss):**
```scss
.menu-link {
    @apply inline-flex items-center rounded-md px-3 py-2 text-sm font-medium uppercase tracking-wide;
    @apply text-slate-700 hover:bg-slate-100 hover:text-slate-900;
    
    @media (min-width: 768px) {
        @apply md:text-white md:hover:bg-white md:hover:bg-opacity-20;
    }
}
```

## Casos de Uso

### 1. Componentes Reutilizables
Cuando una clase se usa en múltiples elementos, debe definirse en CSS:
```scss
.btn-primary {
    @apply px-4 py-2 rounded-lg bg-blue-500 text-white font-medium;
    @apply hover:bg-blue-600 transition-colors;
}

.btn-secondary {
    @apply px-4 py-2 rounded-lg border-2 border-gray-300 text-gray-700;
    @apply hover:border-gray-400 transition-colors;
}
```

### 2. Estados Complejos
Para elementos con múltiples estados (hover, focus, active, etc.):
```scss
.nav-item {
    @apply px-3 py-2 text-slate-700 hover:bg-slate-100 transition-colors;
    
    &.active {
        @apply bg-slate-200 text-slate-900 font-semibold;
    }
    
    &:focus-visible {
        @apply outline-2 outline-offset-2 outline-blue-500;
    }
}
```

### 3. Variaciones Responsivas
Para elementos que cambian según el breakpoint:
```scss
.card {
    @apply w-full;
    
    @media (min-width: 768px) {
        @apply w-1/2;
    }
    
    @media (min-width: 1024px) {
        @apply w-1/3;
    }
}
```

## Convenciones de Nombres

- Usar kebab-case para nombres de clases
- Nombre descriptivo y específico del componente
- Prefijo del componente si aplica

**Ejemplos:**
- `.menu-link` - enlace de menú
- `.mobile-menu-button` - botón de menú móvil
- `.hero-section` - sección hero
- `.card-primary` - tarjeta principal

## Ubicación de Estilos

| Tipo de Componente | Ubicación |
|---|---|
| Header y navegación | `src/assets/sass/header.scss` |
| Footer | `src/assets/sass/footer.scss` |
| WooCommerce | `src/assets/sass/woocommerce.scss` |
| Botones y core | `src/assets/sass/core/buttons.scss` |
| Estilos globales | `src/assets/sass/style.scss` |

## Proceso de Build

Después de modificar cualquier archivo SCSS:

```bash
npm run build  # Compilar Sass a CSS y sincronizar archivos
```

Esto generará:
- `lb19/assets/css/style.css` - CSS compilado y minificado
- `lb19/template-parts/**` - Archivos sincronizados desde src

## Archivo theme.json

Para paleta de colores y variables globales:
- Definir colores base en `src/theme.json`
- Usar variables CSS en los archivos SCSS
- Evitar hardcodear colores en clases individuales

## Excepciones

Las siguientes situaciones **pueden** usar clases Tailwind directamente:
1. **Utilidades de una sola línea**: Márgenes, padding, display en casos muy específicos
2. **Estilos únicos**: Clases que se usan solo en un lugar específico
3. **Prototipos rápidos**: Durante desarrollo rápido (refactorizar después)

Aún así, preferir definir en CSS cuando sea posible.

## Checklist para Revisión

- [ ] Las clases HTML son descriptivas y usan kebab-case
- [ ] Los estilos están definidos en archivos SCSS/CSS
- [ ] Se usa `@apply` para aplicar clases Tailwind
- [ ] Las clases se reutilizan en múltiples lugares
- [ ] Los estilos están en la ubicación correcta según el tipo
- [ ] Sin clases Tailwind directamente en el HTML (excepto utilidades simples)
- [ ] El build se ejecutó después de cambios (`npm run build`)
