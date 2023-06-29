function ajouterContact() {

    let contactHTML = `
    <div class="form-group">
        <label for="contacts[]">Contact :</label>
        <select name="contacts[]" id="contacts" class="form-control">
            <option value="">Sélectionnez un contact</option>
            <?php foreach ($contacts as $contacts) : ?>
                <option value="<?php echo $contacts->getId(); ?>"><?php echo $contacts->getFirstName().' '.$contacts->getLastName(); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" class="btn btn-danger" onclick="supprimerContact(this)">Supprimer</button>
    </div>
    `;
    
    let contactContainer = document.getElementById("contactContainer");
    contactContainer.insertAdjacentHTML('beforeend', contactHTML);
    }

function supprimerContact(button) {
    
    let contactDiv = button.parentNode;
    contactDiv.parentNode.removeChild(contactDiv);
}