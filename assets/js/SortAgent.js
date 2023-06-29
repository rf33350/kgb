    document.querySelector('.form').addEventListener('submit', function(event) {
        // Récupérer l'agent sélectionné
        let agentSelect = document.getElementById('agents');
        let selectedAgentOption = agentSelect.options[agentSelect.selectedIndex];
        let selectedAgentSpecialityId = selectedAgentOption.getAttribute('data-speciality');

        // Récupérer la spécialité requise
        let missionSpecialityId = "<?php echo $mission->getSpeciality_id(); ?>";

        // Vérifier si la spécialité de l'agent sélectionné correspond à la spécialité requise
        if (selectedAgentSpecialityId !== missionSpecialityId) {
            // La première spécialité de l'agent ne correspond pas à la spécialité requise
            // Gérer l'erreur ou afficher un message à l'utilisateur
            event.preventDefault(); // Empêcher l'envoi du formulaire
            alert('L\'agent sélectionné ne possède pas la spécialité requise.');
        }
    });
