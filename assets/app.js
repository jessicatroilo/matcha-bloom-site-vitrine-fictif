import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('burger-menu').addEventListener('click', function () {
  const menu = document.getElementById('menu');
  menu.classList.toggle('hidden');
  });
});

document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('search-menu').addEventListener('click', function () {
    const search = document.querySelector('#search');
    const iconSearch = document.querySelector('#icon-search');

    search.classList.toggle('hidden');

    // Vérifie si l'icône existe déjà et la supprime
    if (iconSearch.classList.contains('fa-magnifying-glass')) {
      iconSearch.classList.remove('fa-magnifying-glass', 'text-matcha-accent');
      iconSearch.classList.add('fa-x', 'text-pink-watermelon');
    } else {
      iconSearch.classList.remove('fa-x', 'text-pink-watermelon');
      iconSearch.classList.add('fa-magnifying-glass', 'text-matcha-accent');
    }
  });
});
