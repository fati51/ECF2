
        $(document).ready(function() {
            // Lorsque le formulaire de recherche est soumis
            $("#searchForm").submit(function(event) {
                event.preventDefault(); // Empêcher le rechargement de la page

                // Récupérer les valeurs de recherche
                var query = $("#searchInput").val();
                var criteria = $("#searchCriteria").val();

                // Charger les résultats de recherche dans le conteneur
                $("#searchResults").load("barre_recherche.php?query=" + query + "&critere=" + criteria);
            });
        });
    