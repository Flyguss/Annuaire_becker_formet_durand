document.addEventListener("DOMContentLoaded", function() {
    const apiUrl = 'http://localhost:42064/api/entrees';

    async function fetchEntries() {
        try {
            const response = await fetch(apiUrl);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            displayEntries(data);
        } catch (error) {
            console.error('Error fetching entries:', error);
        }
    }

    function displayEntries(data) {
        const entriesContainer = document.getElementById('entries-container');
        entriesContainer.innerHTML = '';

        data.entres.forEach(entry => {
            const entryDiv = document.createElement('div');
            entryDiv.className = 'entry';
            entryDiv.innerHTML = `
                <h3>${entry.nom} ${entry.prenom}</h3>
                <p>Département: ${entry.departements.join(', ')}</p>
            `;
            entriesContainer.appendChild(entryDiv);
        });
    }

    fetchEntries();
});
