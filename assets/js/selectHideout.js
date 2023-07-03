// Chargement des planques en fonction du pays sélectionné
document.getElementById('country').addEventListener('change', function() {
    const country = this.value;
    const hideoutsSelect = document.getElementById('hideouts');
  
    // Réinitialisation des options de la liste déroulante des planques
    hideoutsSelect.innerHTML = '<option value="">Sélectionnez une planque</option>';
  
    // Vérification si un pays est sélectionné
    if (country !== '') {
      // Récupération des planques correspondantes au pays via une requête AJAX (ou autre méthode)
      // Exemple de requête AJAX avec jQuery :
      $.ajax({
        url: 'chemin/vers/script.php',  // Remplacez par le chemin vers votre script de récupération des planques
        method: 'POST',
        data: { country: country },  // Envoyez le pays sélectionné au script
        dataType: 'json',
        success: function(response) {
          // Parcourir les résultats de la requête et ajouter les options à la liste déroulante des planques
          for (let i = 0; i < response.length; i++) {
            const hideout = response[i];
            const option = document.createElement('option');
            option.value = hideout.id;
            option.textContent = hideout.address + ', ' + hideout.country;
            hideoutsSelect.appendChild(option);
          }
        },
        error: function() {
          // Gérer les erreurs de la requête AJAX
        }
      });
    }
  });
  