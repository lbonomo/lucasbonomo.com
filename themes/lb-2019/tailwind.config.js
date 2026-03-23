/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './template-parts/**/*.{php,html}',
    './inc/**/*.{php,html}',
    './assets/js/**/*.js',
    './*.php',
  ],
  theme: {
    extend: {
      colors: {
        primary: 'var(--color-primary)',
        'primary-text': 'var(--color-primary-text)',
        secondary: 'var(--color-secondary)',
        'secondary-text': 'var(--color-secondary-text)',
      },
      spacing: {
        '4.5': '1.125rem',
      },
    },
  },
  plugins: [],
  corePlugins: {
    preflight: false, // Desactiva reset de Tailwind si no quieres conflictos con normalize.css
  },
}
