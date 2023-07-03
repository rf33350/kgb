function ajouterTarget() {

    const targetContainer = document.getElementById('targetContainer');

    // Création du nouvel élément div
    const targetDiv = document.createElement('div');
    targetDiv.classList.add('form-group');   
    // Création du label
    const label = document.createElement('label');
    label.setAttribute('for', 'targets[]');
    label.textContent = 'Cible :';  
    // Création du select
    const select = document.createElement('select');
    select.setAttribute('name', 'targets[]');
    select.setAttribute('id', 'targets');
    select.classList.add('form-control');   
    // Création de l'option par défaut
    const defaultOption = document.createElement('option');
    defaultOption.setAttribute('value', '');
    defaultOption.textContent = 'Sélectionnez une cible';    
    // Ajout de l'option par défaut au select
    select.appendChild(defaultOption);
    
    const targetsSelect = document.getElementById('targets');
    const allTargets = Array.from(targetsSelect.options)
        .filter(option => option.value !== '')
        .map((option, index) => ({
            id: option.value,
            name: option.textContent.trim()
          }));

    allTargets.forEach(target => {
        const option = document.createElement('option');
        option.setAttribute('value', target.id);
        option.textContent = target.name;
        select.appendChild(option);
    });
    
    // Ajout du label et du select à la div
    targetDiv.appendChild(label);
    targetDiv.appendChild(select);
    
    // Ajout de la div à la div agentContainer
    targetContainer.appendChild(targetDiv);

    const removeBtn = document.createElement('button');
    removeBtn.classList.add('btn', 'btn-sm', 'btn-danger');
    removeBtn.textContent = 'Supprimer';
    removeBtn.addEventListener('click', () => {
        targetDiv.remove();
    });

    targetDiv.appendChild(removeBtn);
}