# Flujo de Build Actualizado - Vite

## 📋 Cambios realizados

Se ha eliminado **Grunt** y se ha reemplazado con **Vite** como herramienta de build moderna.

### ✅ Antes (Grunt)
```bash
npm run dev    # Ejecutaba: grunt dev (watch con sass + sync)
npm run build  # Ejecutaba: grunt build (clean + sync + sass)
```

### ✅ Ahora (Vite)
```bash
npm run dev    # Ejecuta Vite dev server con HMR en puerto 5173
npm run build  # Compila assets + sincroniza archivos estáticos
npm run sync   # Solo sincroniza archivos (sin compilación)
npm run preview # Previsualiza el build
```

## 🏗️ Arquitectura nueva

### Compilación (Vite)
- **Entrada**: `src/main.js`, `src/style.css`, `src/assets/js/{customizer,palette}.js`
- **Salida**: `lb19/assets/{js,css}/*.min.{js,css}`
- **Cache busting**: Automatizado (hashes en nombres)
- **CSS**: PostCSS + Tailwind + Autoprefixer

### Sincronización de archivos estáticos
- **Plugin**: `vite-plugin-copy` (durante el build)
- **Script fallback**: `scripts/copy-theme-files.js` (después del build)
- Copia:
  - ✅ `**/*.php`
  - ✅ `acf-json/**` (campos personalizados)
  - ✅ `assets/images/**` y `assets/fonts/**`
  - ✅ `theme.json`, `*.txt`, `rtl.css`

## 🔄 Workflow

### Desarrollo
```bash
npm run dev
```
- Inicia Vite en `http://localhost:5173`
- Hot Module Reload (HMR) automático
- Los cambios en JS/CSS se reflejan instántaneamente
- Los cambios en PHP/JSON requieren refresh manual

### Build final
```bash
npm run build
```
1. Vite compila JS y CSS a `lb19/assets/`
2. `vite-plugin-copy` copia archivos estáticos
3. `scripts/copy-theme-files.js` sincroniza lo restante
4. Resultado: `lb19/` listo para usar

### Deploy
```bash
./build.sh
```
- Ejecuta `npm run build`
- Genera ZIP automaticamente (ej: `lb-2019.1.2.2.zip`)

## 📦 Dependencias cambio

**Removidas:**
- ❌ grunt
- ❌ grunt-sync
- ❌ grunt-contrib-clean
- ❌ grunt-contrib-watch
- ❌ grunt-contrib-sass
- ❌ grunt-browser-sync

**Agregadas:**
- ✅ vite-plugin-copy (^0.0.14)

## 🔍 Verificar instalación

```bash
npm install
npm run build
```

Debería generar:
```
lb19/
├── assets/
│   ├── css/style.min.css
│   ├── js/main.min.js
│   ├── js/customizer.min.js
│   ├── images/**
│   └── fonts/**
├── acf-json/
├── *.php
└── theme.json
```

## ⚡ Ventajas Vite

- 🚀 **10-100x más rápido** que Grunt
- 🔥 **Hot Module Reload** nativo
- 📦 **Output moderno** (ES modules, tree-shaking)
- 🎯 **Zero config** para casos estándar
- 🔗 **Compatible con Tailwind + PostCSS**

## 🐛 Troubleshooting

### Los cambios en PHP no se reflejan
→ Actualiza manualmente o ejecuta `npm run sync`

### Port 5173 en uso
→ Configura otro puerto en `vite.config.js` (`server.port`)

### Archivos no se copian a lb19/
→ Verifica que existan en `src/` y ejecuta `npm run build` de nuevo

---

**Gruntfile.js**: Mantenido como referencia (comentado).  
**Última actualización**: 2026-03-24
