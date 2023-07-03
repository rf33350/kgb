function ajouterContact() {

    const contactContainer = document.getElementById('contactContainer');

    // Création du nouvel élément div
    const contactDiv = document.createElement('div');
    contactDiv.classList.add('form-group');   
    // Création du label
    const label = document.createElement('label');
    label.setAttribute('for', 'contacts[]');
    label.textContent = 'Contact :';  
    // Création du select
    const select = document.createElement('select');
    select.setAttribute('name', 'contacts[]');
    select.setAttribute('id', 'contacts');
    select.classList.add('form-control');   
    // Création de l'option par défaut
    const defaultOption = document.createElement('option');
    defaultOption.setAttribute('value', '');
    defaultOption.textContent = 'Sélectionnez un contact';    
    // Ajout de l'option par défaut au select
    select.appendChild(defaultOption);
    
    const contactsSelect = document.getElementById('contacts');
    const allContacts = Array.from(contactsSelect.options)
        .filter(option => option.value !== '')
        .map((option, index) => ({
            id: option.value,
            name: option.textContent.trim()
          }));

    allContacts.forEach(contact => {
        const option = document.createElement('option');
        option.setAttribute('value', contact.id);
        option.textContent = contact.name;
        select.appendChild(option);
    });
    
    // Ajout du label et du select à la div
    contactDiv.appendChild(label);
    contactDiv.appendChild(select);
    
    // Ajout de la div à la div agentContainer
    contactContainer.appendChild(contactDiv);

    const removeBtn = document.createElement('button');
    removeBtn.classList.add('btn', 'btn-sm', 'btn-danger');
    removeBtn.textContent = 'Supprimer';
    removeBtn.addEventListener('click', () => {
        contactDiv.remove();
    });

    contactDiv.appendChild(removeBtn);
}