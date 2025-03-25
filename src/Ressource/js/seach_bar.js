export default SearchBar;

class SearchBar {
    constructor() {
        this.searchMenuButton = document.getElementById("search-menu");
        this.searchContainer = document.getElementById("search");
        this.searchInput = this.searchContainer.querySelector("input");
        this.resultsContainer = document.createElement("div");
        this.iconSearch = document.querySelector("#icon-search");
        this.keywords = this.getKeywords();

        this.setupResultsContainer();
        this.attachEventListeners();
    }

    getKeywords() {
        return [
            { name: "thé matcha", url: "/menu#the-matcha" },
            { name: "pâtisserie", url: "/menu#patisseries" },
            { name: "latte", url: "/menu#lattes" },
            { name: "salon de thé", url: "/salon" },
            { name: "desserts", url: "/menu#desserts" },
            { name: "galerie", url: "/galerie" },
            { name: "donuts", url: "/menu#donuts" },
            { name: "boissons", url: "/menu#boissons" },
            { name: "matcha", url: "/accueil#matcha" },
            { name: "contact", url: "/contact#contact" },
            { name: "mentions légales", url: "/mentions-legales#mentions" },
            { name: "confidentialité", url: "/politique-confidentialité#politique" },
            { name: "politique de cookies", url: "/politique-de-cookies#cookies" },
            { name: "gestion des cookies", url: "/gestion-de-cookies#cookies" },
        ];
    }

    setupResultsContainer() {
        this.resultsContainer.classList.add(
            "absolute", "w-3/5", "bg-white", "border", "border-matcha", 
            "rounded-lg", "mt-1", "shadow-lg", "z-50", "max-h-60", "overflow-auto"
        );
        this.resultsContainer.style.display = "none";
        this.searchContainer.appendChild(this.resultsContainer);
    }

    attachEventListeners() {
        this.searchMenuButton.addEventListener("click", () => this.toggleSearchBar());
        this.searchInput.addEventListener("input", () => this.filterResults());
        document.addEventListener("click", (event) => this.hideResultsOnClickOutside(event));
    }

    toggleSearchBar() {
        this.searchContainer.classList.toggle("hidden");
        this.searchInput.focus();

        if (this.iconSearch.classList.contains("fa-magnifying-glass")) {
            this.iconSearch.classList.replace("fa-magnifying-glass", "fa-x");
            this.iconSearch.classList.replace("text-matcha-accent", "text-pink-watermelon");
        } else {
            this.iconSearch.classList.replace("fa-x", "fa-magnifying-glass");
            this.iconSearch.classList.replace("text-pink-watermelon", "text-matcha-accent");
        }
    }

    filterResults() {
        const query = this.searchInput.value.toLowerCase().trim();
        this.resultsContainer.innerHTML = "";

        if (query.length === 0) {
            this.resultsContainer.style.display = "none";
            return;
        }

        const filteredResults = this.keywords.filter(item => item.name.includes(query));
        if (filteredResults.length > 0) {
            filteredResults.forEach(item => {
                const resultItem = document.createElement("a");
                resultItem.href = item.url;
                resultItem.textContent = item.name;
                resultItem.classList.add("block", "p-2", "hover:bg-matcha-light", "cursor-pointer", "text-matcha-accent");
                this.resultsContainer.appendChild(resultItem);
            });
            this.resultsContainer.style.display = "block";
        } else {
            this.resultsContainer.style.display = "none";
        }
    }

    hideResultsOnClickOutside(event) {
        if (!this.searchContainer.contains(event.target) && event.target !== this.searchMenuButton) {
            this.resultsContainer.style.display = "none";
        }
    }
}

// Initialisation
document.addEventListener("DOMContentLoaded", () => new SearchBar())