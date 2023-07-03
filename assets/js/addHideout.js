function ajouterHideout() {

    const hideoutContainer = document.getElementById('hideoutContainer');

    // Création du nouvel élément div
    const hideoutDiv = document.createElement('div');
    hideoutDiv.classList.add('form-group');   
    // Création du label
    const label = document.createElement('label');
    label.setAttribute('for', 'hideouts[]');
    label.textContent = 'Planque :';  
    // Création du select
    const select = document.createElement('select');
    select.setAttribute('name', 'hideouts[]');
    select.setAttribute('id', 'hideouts');
    select.classList.add('form-control');   
    // Création de l'option par défaut
    const defaultOption = document.createElement('option');
    defaultOption.setAttribute('value', '');
    defaultOption.textContent = 'Sélectionnez une planque';    
    // Ajout de l'option par défaut au select
    select.appendChild(defaultOption);

    const hideoutsSelect = document.getElementById('hideouts');
    const allHideouts = Array.from(hideoutsSelect.options)
        .filter(option => option.value !== '')
        .map((option, index) => ({
            id: option.value,
            name: option.textContent.trim()
          }));

    allHideouts.forEach(hideout => {
        const option = document.createElement('option');
        option.setAttribute('value', hideout.id);
        option.textContent = hideout.name;
        select.appendChild(option);
    });
    
    // Ajout du label et du select à la div
    hideoutDiv.appendChild(label);
    hideoutDiv.appendChild(select);
    
    // Ajout de la div à la div agentContainer
    hideoutContainer.appendChild(hideoutDiv);

    const removeBtn = document.createElement('button');
    removeBtn.classList.add('btn', 'btn-sm', 'btn-danger');
    removeBtn.textContent = 'Supprimer';
    removeBtn.addEventListener('click', () => {
        hideoutDiv.remove();
    });

    hideoutDiv.appendChild(removeBtn);
}