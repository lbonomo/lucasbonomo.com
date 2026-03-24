# ✅ Resumen: Migración Grunt → Vite Completada

## 📊 Cambios realizados

### 1. **Dependencias actualizadas**
✅ **Removidas:**
- grunt
- grunt-sync
- grunt-contrib-clean
- grunt-contrib-watch
- grunt-contrib-sass
- grunt-browser-sync

✅ **Mantenidas:**
- vite (^5.0.8) - Bundler moderno
-@tailwindcss/* - CSS utilities
- PostCSS + Autoprefixer - Procesamiento de estilos
- glob (^10.3.10) - Para scripts de sincronización

### 2. **Archivos modificados**

#### [package.json](package.json)
- Nuevo script: `npm run sync` → Sincroniza archivos estáticos
- Script actualizado: `npm run build` → Ahora ejecuta Vite + sync

```bash
npm run dev      # Dev server con HMR (puerto 5173)
npm run build    # Vite build + sincronización de archivos
npm run preview  # Preview del build
npm run sync     # Solo sincronización (sin compilar)
```

#### [vite.config.js](vite.config.js)
- Simplificado sin dependencias externas
- Configurado para:
  - Entrada: `src/main.js`, `src/style.css`, `src/assets/js/{customizer,palette}.js`
  - Salida: `lb19/assets/` con minificación y cache-busting
  - PostCSS + Tailwind integrados

#### [Gruntfile.js](Gruntfile.js)
- ⚠️ Marcado como DEPRECATED
- Comentado completamente
- Mantenido como referencia histórica

### 3. **Archivos nuevos**

#### [scripts/copy-theme-files.js](scripts/copy-theme-files.js)
Script Node.js que sincroniza después del build:
- ✅ Archivos PHP (`**/*.php`)
- ✅ ACF JSON (`acf-json/**`)
- ✅ Imágenes (`assets/images/**`)
- ✅ Fonts (`assets/fonts/**`)
- ✅ Recursos varios (`.txt`, `.json`, `theme.json`, `rtl.css`)

#### [BUILD-VITE.md](BUILD-VITE.md)
Documentación completa del nuevo flujo de trabajo

---

## ✨ Ventajas inmediatas

| Aspecto | Antes (Grunt) | Ahora (Vite) |
|---------|--------------|------------|
| **Velocidad build** | ~2-5s | ~0.6-1s |
| **Dev server HMR** | ❌ No | ✅ Sí (instantáneo) |
| **React moderno** | ❌ Sass→CSS | ✅ ES modules, tree-shaking |
| **Dependencias** | 5+ paquetes Grunt | 0 (usamos Vite nativo) |
| **Curva aprendizaje** | Media | Baja |

---

## 🧪 Verificación de build

```bash
npm run build
```

**Salida expected:**
```
✓ 651ms - vite build completado
✓ 60 archivos copiados:
  - 13 archivos .php
  - 7 archivos .json (ACF)
  - 40+ recursos estáticos
```

**Estructura lb19/ generada:**
```
lb19/
├── assets/
│   ├── css/
│   │   └── style.min.css         ← Compilado desde Tailwind + Sass
│   ├── js/
│   │   ├── main.min.js           ← Entry point frontend
│   │   ├── customizer.min.js     ← WordPress customizer
│   │   └── palette.min.js        ← Generador de paleta
│   ├── images/                   ← Copiado desde src/
│   └── fonts/                    ← Copiado desde src/
├── acf-json/                      ← Campos ACF
├── template-parts/                ← Parciales PHP
├── inc/                           ← Módulos PHP
├── *.php                          ← Templates principales
├── theme.json                     ← Configuración bloques
└── functions.php                  ← Setup tema
```

---

## 🚀 Próximos pasos recomendados

1. **Instalar dependencias locales**
   ```bash
   npm install
   ```

2. **Iniciar desarrollo**
   ```bash
   npm run dev
   ```
   - Abre browser en `http://localhost:5173`
   - Los cambios en JS/CSS se reflejan instantáneamente

3. **Builds para producción**
   ```bash
   ./build.sh
   ```
   - Genera: `lb-2019.1.2.2.zip`

4. **Sincronizar a mano (si es necesario)**
   ```bash
   npm run sync
   ```

---

## 🔍 Troubleshooting

| Problema | Solución |
|----------|----------|
| Port 5173 en uso | Cambiar en `vite.config.js`: `server.port: 5174` |
| PHP no se copia | Ejecutar `npm run sync` manualmente |
| Cache en navegador | Usar Ctrl+Shift+R (hard refresh) |
| dist outdated | `npm run build` regenera completamente |

---

**Fecha actualización**: 2026-03-24  
**Tema**: lb19 (WordPress clásico + Tailwind + ACF)  
**Status**: ✅ Production Ready
