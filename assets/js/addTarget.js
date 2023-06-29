function ajouterTarget() {

    let targetHTML = `
    <div class="form-group">
        <label for="targets[]">Cible :</label>
        <select name="targets[]" id="targets" class="form-control">
            <option value="">Sélectionnez une cible</option>
            <?php foreach ($targets as $target) : ?>
                <option value="<?php echo $target->getId(); ?>"><?php echo $target->getFirstName().' '.$target->getLastName(); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" class="btn btn-danger" onclick="supprimerTarget(this)">Supprimer</button>
    </div>
    `;
    
    let targetContainer = document.getElementById("targetContainer");
    targetContainer.insertAdjacentHTML('beforeend', targetHTML);
    }

function supprimerTarget(button) {
    
    let targetDiv = button.parentNode;
    targetDiv.parentNode.removeChild(targetDiv);
}