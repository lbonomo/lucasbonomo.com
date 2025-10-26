/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php",
    "./**/*.html",
    "./src/**/*.js",
    "./src/**/*.css"
  ],
  theme: {
    extend: {
      colors: {
        primary: '#1E3A8A',
        secondary: '#6B7280',
        accent: '#F59E0B',
        background: '#FFFFFF',
        text: '#111827',
        'light-accent': '#E5E7EB',
        'blue-accent': 'rgb(37, 99, 235)',
        success: '#10B981',
      },
      fontSize: {
        'x-small': '0.75rem',
        small: '0.875rem',
        medium: '1rem',
        large: '1.25rem',
        'x-large': '1.5rem',
        'xx-large': '2rem',
        'xxx-large': '3.75rem',
      },
      spacing: {
        10: '0.25rem',
        20: '0.5rem',
        30: '1rem',
        40: '1.5rem',
        50: '2rem',
        60: '3rem',
      },
      maxWidth: {
        'content': '800px',
        'wide': '1200px',
      },
    },
  },
  plugins: [],
}