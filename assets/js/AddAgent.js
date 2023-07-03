function ajouterAgent() {

    const agentContainer = document.getElementById('agentContainer');

    // Création du nouvel élément div
    const agentDiv = document.createElement('div');
    agentDiv.classList.add('form-group');   
    // Création du label
    const label = document.createElement('label');
    label.setAttribute('for', 'agents[]');
    label.textContent = 'Agent :';  
    // Création du select
    const select = document.createElement('select');
    select.setAttribute('name', 'agents[]');
    select.setAttribute('id', 'agents');
    select.classList.add('form-control');   
    // Création de l'option par défaut
    const defaultOption = document.createElement('option');
    defaultOption.setAttribute('value', '');
    defaultOption.textContent = 'Sélectionnez un agent';    
    // Ajout de l'option par défaut au select
    select.appendChild(defaultOption);
    
    const agentsSelect = document.getElementById('agents');
    const allAgents = Array.from(agentsSelect.options)
        .filter(option => option.value !== '')
        .map((option, index) => ({
            id: option.value,
            name: option.textContent.trim()
          }));

    allAgents.forEach(agent => {
        const option = document.createElement('option');
        option.setAttribute('value', agent.id);
        option.textContent = agent.name;
        select.appendChild(option);
    });
    
    // Ajout du label et du select à la div
    agentDiv.appendChild(label);
    agentDiv.appendChild(select);
    
    // Ajout de la div à la div agentContainer
    agentContainer.appendChild(agentDiv);

    const removeBtn = document.createElement('button');
    removeBtn.classList.add('btn', 'btn-sm', 'btn-danger');
    removeBtn.textContent = 'Supprimer';
    removeBtn.addEventListener('click', () => {
        agentDiv.remove();
    });

    agentDiv.appendChild(removeBtn);
}

