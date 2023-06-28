function ajouterAgent() {

    let agentHTML = `
    <div class="form-group">
        <label for="agents[]">Agent :</label>
        <select name="agents[]" id="agents" class="form-control">
            <option value="">Sélectionnez un agent</option>
            <?php foreach ($agents as $agent) : ?>
                <option value="<?php echo $agent->getId(); ?>"><?php echo $agent->getFirstName().' '.$agent->getLastName(); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" class="btn btn-danger" onclick="supprimerAgent(this)">Supprimer</button>
    </div>
    `;
    
    let agentContainer = document.getElementById("agentContainer");
    agentContainer.insertAdjacentHTML('beforeend', agentHTML);
    }

    function supprimerAgent(button) {
    
    let agentDiv = button.parentNode;
    agentDiv.parentNode.removeChild(agentDiv);
    }