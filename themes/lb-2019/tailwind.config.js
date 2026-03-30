/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './*.php',
    './inc/**/*.php',
    './template-parts/**/*.php',
    './assets/js/**/*.js',
    './assets/css/**/*.css'
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
  plugins: [
    function ({ addBase }) {
      // Keep preflight disabled, but restore the border baseline Tailwind utilities expect.
      addBase({
        '*, ::before, ::after': {
          borderWidth: '0',
          borderStyle: 'solid',
          borderColor: 'currentColor',
        },
      })
    },
  ],
  corePlugins: {
    preflight: false, // Desactiva reset de Tailwind si no quieres conflictos con normalize.css
  },
}
