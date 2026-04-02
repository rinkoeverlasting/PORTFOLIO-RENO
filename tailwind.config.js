/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'neon-blue': '#00f3ff',
        'neon-purple': '#bc13fe',
        'dark-bg': '#0a0a0a',
        'dark-card': '#1a1a1a',
      },
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
        'orbitron': ['Orbitron', 'sans-serif'],
      },
      boxShadow: {
        'neon-blue': '0 0 5px #00f3ff, 0 0 20px #00f3ff',
        'neon-purple': '0 0 5px #bc13fe, 0 0 20px #bc13fe',
      },
      animation: {
        'flicker': 'flicker 1.5s infinite alternate',
        'neon-border': 'neon-border 2s linear infinite',
      },
      keyframes: {
        flicker: {
          '0%, 19%, 21%, 23%, 25%, 54%, 56%, 100%': {
            opacity: 1,
          },
          '20%, 22%, 24%, 55%': {
            opacity: 0.5,
          },
        },
        'neon-border': {
          '0%': { 'border-color': '#00f3ff' },
          '50%': { 'border-color': '#bc13fe' },
          '100%': { 'border-color': '#00f3ff' },
        }
      }
    },
  },
  plugins: [],
}
