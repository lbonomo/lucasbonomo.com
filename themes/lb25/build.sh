#!/bin/bash

# Nombre del tema y versión
THEME_NAME=$(grep "Text Domain:" style.css | cut -d':' -f2 | tr -d ' ')
VERSION=$(grep "Version:" style.css | cut -d':' -f2 | tr -d ' ')
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
OUTPUT_FILE="zips/${THEME_NAME}.${VERSION}.zip"

# Crear directorio temporal
TEMP_DIR="temp_build"
mkdir -p "$TEMP_DIR/${THEME_NAME}"

echo "🚀 Iniciando proceso de empaquetado del tema ${THEME_NAME} v${VERSION}..."

# Instalar dependencias de Node.js si no existe node_modules
if [ ! -d "node_modules" ]; then
    echo "📦 Instalando dependencias de Node.js..."
    npm install
fi

# Compilar assets
# echo "🔨 Compilando assets..."
# npm run build

# Lista de archivos y directorios a incluir
FILES_TO_COPY=(
    "assets"
    "inc"
    "screenshot.png"
    "style.css"
    "theme.json"
)

# Agregar todos los archivos .php de la raíz a FILES_TO_COPY
for php_file in ./*.php; do
    [ -e "$php_file" ] && FILES_TO_COPY+=("$(basename "$php_file")")
done

echo "${FILES_TO_COPY[@]}"

# Lista de archivos y directorios a excluir
EXCLUDES=(
    "node_modules"
    "src"
    ".git"
    ".gitignore"
    "package.json"
    "package-lock.json"
    "tailwind.config.js"
    "build.sh"
    "*.zip"
    "temp_build"
    "*.log"
    ".DS_Store"
)

# Copiar archivos necesarios al directorio temporal
echo "📝 Copiando archivos..."
for item in "${FILES_TO_COPY[@]}"; do
    if [ -e "$item" ]; then
        cp -r "$item" "$TEMP_DIR/${THEME_NAME}/"
        echo "✓ Copiado: $item"
    else
        echo "⚠️ Advertencia: $item no encontrado"
    fi
done

# Crear archivo ZIP
echo "🗜️ Creando archivo ZIP..."
cd "$TEMP_DIR"
zip -r "../$OUTPUT_FILE" ./* -x "${EXCLUDES[@]}"
cd ..

# Limpiar directorio temporal
echo "🧹 Limpiando archivos temporales..."
rm -rf "$TEMP_DIR"

echo "✅ ¡Tema empaquetado exitosamente!"
echo "📦 Archivo creado: $OUTPUT_FILE"

# Mostrar el tamaño del archivo
SIZE=$(du -h "$OUTPUT_FILE" | cut -f1)
echo "📊 Tamaño del archivo: $SIZE" 