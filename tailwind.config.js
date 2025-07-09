/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./src/**/*.php",
  ],
  safelist: [
    'bg-yellow-sun-dark',
    'hover:bg-yellow-sun-dark',
    'bg-grey-lavender-dark',
    'hover:bg-grey-lavender-dark',
    'border-yellow-sun-dark',
    'hover:border-yellow-sun-dark',
    'text-yellow-sun-dark',
    'border-grey-lavender-dark',
    'hover:border-grey-lavender-dark',
    'border-grey-lavender',
    'hover:border-grey-lavender',
    'bg-matcha-dark',
  ],
  theme: {
    extend: {
      colors: {
        //site côté client
        'matcha': '#A7C957',
        'matcha-light': '#DAF166',
        'matcha-accent': '#8AB545',
        'grey-lavender': '#D7D7F2',
        'grey-lavender-dark': '#8F8FDF',
        'pink-watermelon': '#FF6B95',
        'yellow-sun': '#FFD93D',
        'yellow-sun-dark': '#EFC30C',
        'text': '#464242',
        'text-light': '#FFFFFF',
        'footer-text': '#FFF8E2',
        'btn-light': '#FFFAFA',

        //site côté admin
        'matcha-dark': '#466b4d',

        // Lavande grisé pour fond de page backoffice
        'lavender-soft': '#f3f3f9',

        // Textes gris foncé
        'text-main': '#1e293b', // gris-800

        // Utilitaires
        'neutral-bg': '#ffffff', // fond des cartes
        'neutral-border': '#d1d5db', // gris-300
        'highlight': '#e2e8f0', // gris bleuté clair

        // Alerte
        'success': '#15803d', // vert foncé
        'error': '#dc2626',   // rouge
        'warning': '#d97706', // orange

        // Lien
      },

      backgroundImage: {
        //'footer': "url('/public/images/footer-bg.avif'), url('/public/images/footer-bg.webp'), url('/public/images/footer-bg.svg')",
        //'hero' : "url('/public/images/accueil-hero-bg.avif'), url('/public/images/accueil-hero-bg.webp'), url('/public/images/accueil-hero-bg.svg')",
        'footer' : "url('/public/images/footer-bg.webp')",
        'hero' : "url('/public/images/accueil-bg-hero.webp')",
        'all-pages' : "url('/public/images/all-page-bg.webp')",
      },
    },
  },
  plugins: [],
}

