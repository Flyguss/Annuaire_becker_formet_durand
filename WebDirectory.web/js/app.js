document.addEventListener('DOMContentLoaded', () => {
    const entriesList = document.getElementById('entriesList');
    const filterSelect = document.getElementById('filterSelect');


    // Fonction pour charger et afficher la liste des entrées
    async function loadEntries() {
        try {
            const response = await fetch('http://localhost:42064/api/entrees');
            if (!response.ok) {
                throw new Error('Erreur lors du chargement des données');
            }
            const data = await response.json();
            displayEntries(data.entres);
            populateFilterOptions(data.departements); // Remplir les options du menu déroulant
        } catch (error) {
            console.error('Erreur:', error);
        }
    }

    // Fonction pour remplir les options du menu déroulant
    function populateFilterOptions(departments) {
        filterSelect.innerHTML = '<option value="">Tous les services</option>';
        departments.forEach(dep => {
            filterSelect.innerHTML += `<option value="${dep.id}">${dep.nom}</option>`;
        });
    }

    // Fonction pour filtrer et afficher les entrées par service/département sélectionné
    async function filterEntries(departmentId) {
        try {
            let url = 'http://localhost:42064/api/entrees';
            if (departmentId) {
                url += `?service=${departmentId}`;
            }
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error('Erreur lors du chargement des données');
            }
            const data = await response.json();
            displayEntries(data.entres);
        } catch (error) {
            console.error('Erreur:', error);
        }
    }

    // Fonction pour afficher les entrées dans la liste
    function displayEntries(entries) {
        entriesList.innerHTML = ''; // Réinitialiser la liste
        entries.forEach(entry => {
            const li = document.createElement('li');
            li.innerHTML = `
                <strong>${entry.nom} ${entry.prenom}</strong> (${entry.departements.join(', ')})
            `;
            entriesList.appendChild(li);
        });
    }

    // Fonction pour rechercher et afficher les entrées correspondant à un critère de recherche
    async function searchEntries() {
        const query = prompt('Entrez le nom à rechercher :');
        if (!query) return;

        try {
            const response = await fetch(`http://localhost:42064/api/entrees?q=${query}`);
            if (!response.ok) {
                throw new Error('Erreur lors du chargement des donnees');
            }
            const data = await response.json();
            displayEntries(data.entres);
        } catch (error) {
            console.error('Erreur:', error);
        }
    }

    // Appel initial pour charger la liste des entrées au chargement de la page
    loadEntries();
});
