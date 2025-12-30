/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        // Dracula Theme Colors
        dracula: {
          bg: '#282a36',
          bg_light: '#44475a',
          fg: '#f8f8f2',
          selection: '#44475a',
          comment: '#6272a4',
          red: '#ff5555',
          orange: '#ffb86c',
          yellow: '#f1fa8c',
          green: '#50fa7b',
          cyan: '#8be9fd',
          purple: '#bd93f9',
          pink: '#ff79c6',
        },
      },
      fontFamily: {
        sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
