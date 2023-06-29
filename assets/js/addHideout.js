function ajouterHideout() {

    let hideoutHTML = `
    <div class="form-group">
        <label for="hideouts[]">Planque :</label>
        <select name="hideouts[]" id="hideouts" class="form-control">
            <option value="">Sélectionnez une planque</option>
            <?php foreach ($hideouts as $hideout) : ?>
                <option value="<?php echo $hideout->getId(); ?>"><?php echo $hideout->getAddress().' '.$hideout->getCountry(); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" class="btn btn-danger" onclick="supprimerHideout(this)">Supprimer</button>
    </div>
    `;
    
    let hideoutContainer = document.getElementById("hideoutContainer");
    hideoutContainer.insertAdjacentHTML('beforeend', hideoutHTML);
    }

function supprimerHideout(button) {
    
    let hideoutDiv = button.parentNode;
    hideoutDiv.parentNode.removeChild(hideoutDiv);
}