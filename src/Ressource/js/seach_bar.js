// Je vais créer un module de recherche
// ATTENTION NE PAS OUBLIER de mettre le nom de constante devant les éléments
const searchBar = {
//mes données de la barre de recherche
keywords : [
    { name: "thé matcha", url: "/menu" },
    { name: "pâtisserie", url: "/menu#patisseries" },
    { name: "latte", url: "/menu#lattes" },
    { name: "salon de thé", url: "/salon" },
    { name: "desserts", url: "/menu#desserts" },
    { name: "galerie", url: "/galerie" },
    { name: "donuts", url: "/menu#donuts" },
    { name: "boissons", url: "/menu#boissons" },
    { name: "matcha", url: "/#matcha" },
    { name: "contact", url: "/contact#contact" },
    { name: "mentions légales", url: "/mentions-legales#mentions" },
    { name: "confidentialité", url: "/politique-confidentialité#politique" },
    { name: "politique de cookies", url: "/politique-de-cookies#cookies" },
    { name: "gestion des cookies", url: "/gestion-de-cookies#cookies" },
],

// mes popriétés liés au DOM à null
inputElement : null,
resultsElement : null,
containerElement : null,
iconElement : null,
buttonOpenElement : null,

// ma fonction d'initialisation
init: function(){
    // je récupère mes éléments du DOM
    searchBar.inputElement = document.querySelector("#search-input");
    searchBar.resultsElement = document.querySelector("#search-results");
    searchBar.containerElement = document.querySelector("#search");
    searchBar.iconElement = document.querySelector("#icon-search");
    searchBar.buttonOpenElement = document.querySelector("#search-menu");


    // j'ajoute mes écouteurs d'événements
    //event pour ouvrir la barre de recherche
    searchBar.buttonOpenElement.addEventListener("click",searchBar.handleToggleSearchBar);
    //recupérer les mots clés de mon input
    searchBar.inputElement.addEventListener("keyup",searchBar.handleKeyWordsInput);

},

//* ici je vais créer mes fonctions
// fonction pour afficher la barre de recherche
handleToggleSearchBar : function() {
    const isHidden = searchBar.containerElement.classList.contains("hidden");
    //searchBar.containerElement.classList.toggle("hidden");

    if (isHidden) {
    searchBar.containerElement.classList.remove("hidden"); // Affiche la barre
    searchBar.inputElement.focus();
    searchBar.inputElement.value = ""; // Reset input
    searchBar.iconElement.classList.replace("fa-magnifying-glass", "fa-x");
    searchBar.iconElement.classList.replace("text-matcha-accent", "text-pink-watermelon");
    } else {
    searchBar.containerElement.classList.add("hidden"); 
    searchBar.iconElement.classList.replace("fa-x", "fa-magnifying-glass");
    searchBar.iconElement.classList.replace("text-pink-watermelon", "text-matcha-accent");
    }
},
// fonction pour récupérer les mots clés de mon input
// pour cela je récupère la valeur de mon input avec la méthode value
handleKeyWordsInput : function(event){
    
    const inputValue = searchBar.inputElement.value;
    
    // je vais filtrer mes mots clés en fonction de la valeur de mon input avec la méthode filter ()
    // je vais utiliser la méthode includes pour vérifier si le mot clé contient la valeur de mon input()
    // je vais utiliser tolowerCase() pour ne pas être sensible à la casse
    const resultsKeywords = searchBar.keywords.filter(item => item.name.toLowerCase().includes(inputValue.toLowerCase()));
    
    //je vais afficher mes résultats dans le DOM
    // je vais créer d'abord une constante vide pour mes résultats
    let resultsSuggestions = "";

    if (inputValue !='') {

    // je vais créer une boucle pour parcourir mes résultats
    // je vais utiliser la méthode forEach pour parcourir mes résultats
    resultsKeywords.forEach (resultItem => 
        resultsSuggestions += `
        <div class="search-result-item">
        <a href="${resultItem.url}" class="search-result-link hover:text-pink-watermelon hover:underline">
            <span class="search-result-name">${resultItem.name}</span>
        </a>
        </div>
        `
    )
    } else {
        // je vais écrire un message si il n'y a pas de résultats
        //! voir comment mettre un message d'erreur 
        resultsSuggestions = `
            <p class="search-result-name">Aucun résultat</p>
        `
    
    }
        //je vais afficher mes résultats dans le DOM
        // je vais utiliser la méthode innerHTML pour afficher mes résultats
        searchBar.resultsElement.innerHTML = resultsSuggestions;

    
}

};


export default searchBar;
/*document.addEventListener("DOMContentLoaded", function () {
searchBar.init();
}
);*/
