#!/usr/bin/env node

/**
 * Copy static theme files from project root to dist/
 * Ejecutado después del build de Vite
 */

import fs from 'fs'
import path from 'path'
import { fileURLToPath } from 'url'
import { globSync } from 'glob'

const __dirname = path.dirname(fileURLToPath(import.meta.url))
const rootDir = path.join(__dirname, '..')
const srcDir = rootDir
const destDir = path.join(rootDir, 'dist')

const patterns = [
  // PHP files
  '**/*.php',
  // ACF JSON
  'acf-json/**/*',
  // Images
  'assets/images/**/*',
  // Languages
  'languages/**/*',
  // Vendor assets
  'vendor/**/*',
  // Misc
  'theme.json',
  'readme.txt',
  'rtl.css',
  'style.css',
  'screenshot.png'
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

/**
 * Copiar directorio completo recursivamente
 */
function copyDirRecursive(src, dest) {
  if (!fs.existsSync(src)) {
    return
  }

  ensureDir(dest)
  fs.cpSync(src, dest, { recursive: true })
}

/**
 * Eliminar directorios legacy de fuentes en dist/assets
 */
function removeLegacyFontDirs(destAssetsDir) {
  const legacyDirs = ['ttf', 'woff', 'woff2', 'otf', 'eot']

  for (const dirName of legacyDirs) {
    const fullPath = path.join(destAssetsDir, dirName)
    if (fs.existsSync(fullPath)) {
      fs.rmSync(fullPath, { recursive: true, force: true })
    }
  }
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
      ignore: [
        'node_modules/**',
        '.git/**',
        '.github/**',
        'docs/**',
        'scripts/**',
        'dist/**',
        'lb19/**',
        '*.min.js',
        '*.min.css'
      ]
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

try {
  const fontsSrc = path.join(srcDir, 'assets/fonts')
  const fontsDest = path.join(destDir, 'assets/fonts')

  copyDirRecursive(fontsSrc, fontsDest)
  removeLegacyFontDirs(path.join(destDir, 'assets'))
} catch (err) {
  console.error(`⚠️  Error copiando assets/fonts: ${err.message}`)
  errorCount++
}

console.log(`✅ Completado: ${copiedCount} archivos copiados`)
if (errorCount > 0) {
  console.log(`⚠️  ${errorCount} error(es) durante la copia`)
}
console.log()
