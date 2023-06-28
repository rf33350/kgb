function ajouterSpecialite() {

    let specialiteHTML = `
    <div class="form-group">
        <label for="specialities[]">Spécialité :</label>
        <select name="specialities[]" class="form-control">
            <option value="">Sélectionnez une spécialité</option>
            <?php foreach ($specialities as $speciality) : ;?>
                <option value="<?php echo $speciality->getId(); ?>"><?php echo $speciality->getTitle(); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" class="btn btn-danger" onclick="supprimerSpecialite(this)">Supprimer</button>
    </div>
    `;
    
    let specialiteContainer = document.getElementById("specialiteContainer");
    specialiteContainer.insertAdjacentHTML('beforeend', specialiteHTML);
    }

    function supprimerSpecialite(button) {
    
    let specialiteDiv = button.parentNode;
    specialiteDiv.parentNode.removeChild(specialiteDiv);
    }