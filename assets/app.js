import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import searchBar from '../src/Ressource/js/seach_bar.js';
import '../src/Ressource/js/burger_menu.js';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');


document.addEventListener("DOMContentLoaded", function () {
  searchBar.init();
});

/* document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('burger-menu').addEventListener('click', function () {
  const menu = document.getElementById('menu');
  menu.classList.toggle('hidden');
  });
});
 */



