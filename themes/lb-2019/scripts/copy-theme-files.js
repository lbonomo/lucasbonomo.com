#!/usr/bin/env node

/**
 * Copy static theme files from src/ to lb19/
 * Ejecutado después del build de Vite
 */

import fs from 'fs'
import path from 'path'
import { fileURLToPath } from 'url'
import { globSync } from 'glob'

const __dirname = path.dirname(fileURLToPath(import.meta.url))
const rootDir = path.join(__dirname, '..')
const srcDir = path.join(rootDir, 'src')
const destDir = path.join(rootDir, 'lb19')

const patterns = [
  // PHP files
  '**/*.php',
  // ACF JSON
  'acf-json/**/*',
  // Images
  'assets/images/**/*',
  // Fonts
  'assets/fonts/**/*',
  // Misc
  '*.txt',
  '*.json',
  'theme.json',
  'readme.txt',
  'rtl.css'
]

/**
 * Crear directorio recursivamente
 */
function ensureDir(dir) {
  if (!fs.existsSync(dir)) {
    fs.mkdirSync(dir, { recursive: true })
  }
}

/**
 * Copiar archivo
 */
function copyFile(src, dest) {
  const dir = path.dirname(dest)
  ensureDir(dir)
  fs.copyFileSync(src, dest)
}

let copiedCount = 0
let errorCount = 0

console.log('📦 Sincronizando archivos de tema...')
console.log(`   Origen: ${srcDir}`)
console.log(`   Destino: ${destDir}\n`)

for (const pattern of patterns) {
  try {
    const files = globSync(pattern, {
      cwd: srcDir,
      nodir: true,
      ignore: ['node_modules/**', '.git/**', '*.min.js', '*.min.css']
    })

    for (const file of files) {
      const src = path.join(srcDir, file)
      const dest = path.join(destDir, file)

      try {
        copyFile(src, dest)
        copiedCount++
      } catch (err) {
        console.error(`  ⚠️  Error copiando ${file}: ${err.message}`)
        errorCount++
      }
    }
  } catch (err) {
    console.error(`⚠️  Error procesando patrón "${pattern}":`, err.message)
    errorCount++
  }
}

console.log(`✅ Completado: ${copiedCount} archivos copiados`)
if (errorCount > 0) {
  console.log(`⚠️  ${errorCount} error(es) durante la copia`)
}
console.log()
