import { defineConfig } from 'vite'
import path from 'path'

function ensureCssMapPlugin() {
  return {
    name: 'ensure-css-map',
    generateBundle(_, bundle) {
      for (const [fileName, item] of Object.entries(bundle)) {
        if ('asset' !== item.type || !fileName.endsWith('.css')) {
          continue
        }

        const mapFileName = `${fileName}.map`
        const cssContent = String(item.source ?? '')

        if (!bundle[mapFileName]) {
          bundle[mapFileName] = {
            type: 'asset',
            fileName: mapFileName,
            source: JSON.stringify({
              version: 3,
              file: path.basename(fileName),
              sources: ['style.css'],
              sourcesContent: [],
              names: [],
              mappings: ''
            })
          }
        }

        if (!cssContent.includes('sourceMappingURL=')) {
          item.source = `${cssContent}\n/*# sourceMappingURL=${path.basename(mapFileName)} */`
        }
      }
    }
  }
}

export default defineConfig(({ mode }) => ({
  root: '.',
  base: '/wp-content/themes/lb19/',
  server: {
    host: '0.0.0.0',
    port: 5173,
    strictPort: true,
    cors: true,
    hmr: {
      host: 'localhost',
      port: 5173,
      protocol: 'ws'
    }
  },
  build: {
    outDir: 'dist',
    emptyOutDir: false,
    sourcemap: 'development' === mode,
    minify: 'development' === mode ? false : 'esbuild',
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'main.js'),
        style: path.resolve(__dirname, 'style.css'),
        customizer: path.resolve(__dirname, 'assets/js/customizer.js'),
        palette: path.resolve(__dirname, 'assets/js/palette.js')
      },
      output: {
        entryFileNames: 'assets/js/[name].min.js',
        chunkFileNames: 'assets/js/[name].[hash].min.js',
        assetFileNames: ({ name }) => {
          if (/\.(woff2?|ttf|otf|eot)$/i.test(name ?? '')) {
            return 'assets/fonts/[name][extname]'
          }
          if (/\.css$/.test(name ?? '')) {
            return 'assets/css/[name].min[extname]'
          }
          return 'assets/[ext]/[name].[hash][extname]'
        }
      }
    }
  },
  css: {
    postcss: './postcss.config.js',
    devSourcemap: true
  },
  plugins: 'development' === mode ? [ensureCssMapPlugin()] : []
}))
