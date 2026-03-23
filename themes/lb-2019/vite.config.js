import { defineConfig } from 'vite'
import { glob } from 'glob'
import path from 'path'

export default defineConfig({
  root: 'src',
  base: '/wp-content/themes/lb19/',
  server: {
    middlewareMode: true,
    cors: true,
    hmr: {
      host: 'localhost',
      port: 5173,
      protocol: 'ws'
    }
  },
  build: {
    outDir: '../lb19',
    emptyOutDir: false,
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'src/main.js'),
        style: path.resolve(__dirname, 'src/style.css'),
        customizer: path.resolve(__dirname, 'src/assets/js/customizer.js'),
        palette: path.resolve(__dirname, 'src/assets/js/palette.js'),
      },
      output: {
        entryFileNames: 'assets/js/[name].min.js',
        chunkFileNames: 'assets/js/[name].[hash].min.js',
        assetFileNames: ({ name }) => {
          if (/\.css$/.test(name ?? '')) {
            return 'assets/css/[name].min[extname]'
          }
          return 'assets/[ext]/[name].[hash][extname]'
        }
      }
    }
  },
  css: {
    postcss: './postcss.config.js'
  }
})
