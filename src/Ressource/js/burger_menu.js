export default MenuBurger;

class MenuBurger {
    constructor(buttonId, menuId) {
        this.menuButton = document.getElementById(buttonId);
        this.menu = document.getElementById(menuId);
        this._addEventListeners();
    }

    // Ajouter les écouteurs d'événements
    _addEventListeners() {
        this.menuButton.addEventListener('click', this.toggleMenu.bind(this));
    }

    // Afficher ou masquer le menu
    toggleMenu() {
        this.menu.classList.toggle('hidden');
    }
    }

    // Initialisation de la classe Menu après le chargement du DOM
    document.addEventListener('DOMContentLoaded', function () {
    const burgerMenu = new MenuBurger('burger-menu', 'menu');
    });