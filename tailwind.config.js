/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./src/**/*.php",
  ],
  theme: {
    colors: {
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
    },
    
    extend: {
      backgroundImage: {
        'footer': "url('/public/images/footer-bg.avif'), url('/public/images/footer-bg.webp'), url('/public/images/footer-bg.svg')",
        'hero' : "url('/public/images/accueil-hero-bg.avif'), url('/public/images/accueil-hero-bg.webp'), url('/public/images/accueil-hero-bg.svg')",
      },
    },
  },
  plugins: [],
}

