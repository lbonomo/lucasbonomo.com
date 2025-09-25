# Comandos y políticas del proyecto

Este archivo almacena las órdenes y comandos relevantes para el desarrollo y mantenimiento del proyecto, siguiendo las mejores prácticas de WordPress.

## Políticas y estándares

- Seguir los estándares de WordPress para PHP, JavaScript, HTML y CSS: https://developer.wordpress.org/coding-standards/wordpress-coding-standards/
- Cada archivo nuevo debe comenzar con una sección de documentación básica, adaptada al tipo de archivo y siguiendo los estándares de WordPress.
- Estructurar los archivos aplicando las mejores prácticas del desarrollo WordPress.
- Almacenar todos los comandos indicados en el directorio del proyecto para referencia futura.

## Herramientas de linting y formateo

- PHP: phpcs con el estándar WordPress (`phpcs.xml`)
- JavaScript: eslint con reglas WordPress (`.eslintrc.json`)
- CSS/HTML: stylelint con configuración WordPress (`.stylelintrc.json`)

## Ejemplo de comandos útiles

```bash
# Instalar dependencias para linting y formateo
npm install --save-dev eslint eslint-plugin-wordpress stylelint stylelint-config-wordpress
composer require --dev wp-coding-standards/wpcs

# Ejecutar PHPCS
vendor/bin/phpcs --standard=phpcs.xml .

# Ejecutar ESLint
npx eslint src/js/

# Ejecutar Stylelint
npx stylelint "src/css/**/*.css"
```

## Notas

Este archivo debe mantenerse actualizado con nuevas órdenes, comandos y políticas relevantes para el proyecto.