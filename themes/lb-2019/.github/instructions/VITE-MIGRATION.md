# Migración de Grunt a Vite

## Resumen

Se ha migrado el stack de compilación del tema de **Grunt** (antiguo) a **Vite** (moderno), manteniendo full compatibilidad con WordPress y Tailwind CSS.

## Cambios Principales

### 1. **Herramientas Reemplazadas**

| Anterior (Grunt) | Ahora (Vite) |
|---|---|
| Grunt (task runner) | Vite (bundler) |
| grunt-contrib-sass | PostCSS + Tailwind |
| grunt-sync | Integrado en Vite |
| grunt-contrib-watch | Vite HMR |
| grunt-contrib-uglify | Vite minification |

### 2. **Stack Moderno**

```
Vite 5
├── PostCSS 8
│   └── Tailwind CSS 3
│   └── Autoprefixer
└── Sass (nativo)
```

### 3. **Archivos Nuevos**

- `vite.config.js` - Configuración de Vite
- `postcss.config.js` - Configuración de PostCSS
- `tailwind.config.js` - Configuración de Tailwind
- `src/main.js` - Entry point de JavaScript
- `src/style.css` - Entry point de estilos

### 4. **Archivos Eliminados**

- ~~`Gruntfile.js`~~ (deprecated)
- ~~grunt-* package devDependencies~~

## Scripts NPM

### Desarrollo
```bash
npm run dev
```
Inicia Vite en modo desarrollo con Hot Module Replacement (HMR). Los cambios se reflejan instantáneamente:
- SCSS/CSS se recarga sin refrescar la página
- JS se recarga y mantiene el estado cuando es posible

### Built/Compilación 
```bash
npm run build
```
Compila para producción en la carpeta `lb19/`:
- Minifica CSS y JavaScript
- Genera `*.min.css` y `*.min.js`
- Optimiza assets

### Preview
```bash
npm run preview
```
Previsualiza la compilación de producción localmente.

## Estructura de Carpetas

```
src/
├── style.css              # Entry point CSS (imports SCSS + Tailwind)
├── main.js                # Entry point JS
├── assets/
│   ├── sass/              # Archivos SCSS individuales
│   │   ├── header.scss
│   │   ├── footer.scss
│   │   └── ...
│   ├── js/
│   │   ├── mobile-menu.js
│   │   ├── navigation.js
│   │   └── ...
│   ├── images/
│   └── fonts/
├── template-parts/
├── inc/
└── *.php

lb19/                      # Output compilado (autogenerado)
├── assets/
│   ├── css/
│   │   └── style.min.css
│   └── js/
│       ├── main.min.js
│       ├── customizer.min.js
│       └── palette.min.js
├── template-parts/
├── inc/
└── *.php
```

## Flujo de Trabajo

### 1. Desarrollo Local

```bash
npm run dev
```

Vite levanta un servidor con HMR en `http://localhost:5173`. Los cambios se sincronizan automáticamente:

- **SCSS:** Se recompila al CSS compilado instantáneamente
- **PHP:** Se sincroniza automáticamente desde `src/` a `lb19/`
- **JS:** Se recarga sin perder estado cuando es posible

### 2. Before Deploying

```bash
npm run build
```

Esto:
- Compila SCSS + Tailwind + estilos custom
- Minifica JavaScript
- Genera archivos con versión
- Copia assets a `lb19/`

### 3. Commit & Deploy

Solo hace commit de cambios en `src/`:
- Los archivos compilados en `lb19/` se regeneran con `npm run build`
- Los commits son más limpios

## Ventajas de Vite

✅ **Más rápido** - Compilación 10-100x más rápida que Grunt
✅ **HMR** - Hot Module Replacement: cambios instantáneos sin refresh
✅ **Moderno** - ES modules nativos, mejor soporte de JavaScript
✅ **Mejor CSS** -PostCSS + Tailwind nativo integrado
✅ **Menos config** - Configuración simplificada vs Grunt
✅ **Dev/Prod iguales** - Mismo código en ambos enviroments

## Configuración de Tailwind

El archivo `tailwind.config.js` detecta automáticamente clases Tailwind en:
- `template-parts/**/*.php`
- `inc/**/*.php`
- `assets/js/**/*.js`
- `*.php` (root)

### Usar @apply

Seguir la convención de CSS Tailwind: definir clases en SCSS usando `@apply`:

**En `header.scss`:**
```scss
.menu-link {
  @apply inline-flex items-center rounded-md px-3 py-2;
  @apply text-sm font-medium uppercase tracking-wide;
  
  @media (min-width: 768px) {
    @apply text-white;
  }
}
```

**En `menu-primary.php`:**
```php
<a href="..." class="menu-link">Enlace</a>
```

## Dependencias

### DevDependencies

```json
{
  "vite": "^5.0.8",
  "tailwindcss": "^3.3.6",
  "postcss": "^8.4.31",
  "autoprefixer": "^10.4.16",
  "glob": "^10.3.10"
}
```

Instalar cualquier nueva dependencia:
```bash
npm install --save-dev [package-name]
```

## Troubleshooting

### "No utility classes detected"
Verificar que el `content` en `tailwind.config.js` incluya los archivos correctos.

### CSS no se actualiza en desarrollo
Verificar que el archivo esté siendo importado en `src/style.css` o `src/main.js`.

### Cambios de PHP no se reflejan
Los cambios de PHP los maneja Vite automáticamente. Hacer un refresh del navegador.

### Errores de compilación SCSS
Usar la sintaxis correcta de SCSS. Vite usa el compilador nativo de Sass.

## Próximos Pasos

1. ~~Eliminar Gruntfile.js~~ (opcional, ya no se usa)
2. Ejecutar `npm run build` antes de cada deploy
3. Usar `npm run dev` para desarrollo local
4. Mantener cambios en `src/`, usar `lb19/` solo como output

## Recursos

- [Vite Documentation](https://vitejs.dev)
- [Tailwind CSS](https://tailwindcss.com)
- [PostCSS](https://postcss.org)
- [SCSS Syntax](https://sass-lang.com)

---

**Última actualización:** Marzo 2026  
**Versión del tema:** 1.2.2  
**Stack:** Vite 5 + Tailwind 3 + PostCSS 8
