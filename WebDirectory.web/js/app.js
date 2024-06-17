document.addEventListener('DOMContentLoaded', () => {
    const apiBaseUrl = 'http://localhost:8080/api';

    const entriesList = document.getElementById('entries-list');
    const entryDetail = document.getElementById('entry-detail');
    const searchInput = document.getElementById('search');

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.trim();
        if (query) {
            searchEntries(query);
        } else {
            fetchEntries();
        }
    });

    async function fetchEntries() {
        try {
            const response = await fetch(`${apiBaseUrl}/entrees`);
            const data = await response.json();
            displayEntries(data.entres);
        } catch (error) {
            console.error('Error fetching entries:', error);
        }
    }

    async function searchEntries(query) {
        try {
            const response = await fetch(`${apiBaseUrl}/entrees?q=${query}`);
            const data = await response.json();
            displayEntries(data.entres);
        } catch (error) {
            console.error('Error searching entries:', error);
        }
    }

    function displayEntries(entries) {
        entriesList.innerHTML = entries.map(entry => `
            <div class="entry" data-id="${entry.id}">
                <h2>${entry.nom} ${entry.prenom}</h2>
                <p>${entry.departements.join(', ')}</p>
            </div>
        `).join('');

        document.querySelectorAll('.entry').forEach(entryElement => {
            entryElement.addEventListener('click', () => {
                const entryId = entryElement.dataset.id;
                fetchEntryDetail(entryId);
            });
        });
    }

    async function fetchEntryDetail(entryId) {
        try {
            const response = await fetch(`${apiBaseUrl}/entrees/${entryId}`);
            const data = await response.json();
            displayEntryDetail(data.entre);
        } catch (error) {
            console.error('Error fetching entry detail:', error);
        }
    }

    function displayEntryDetail(entry) {
        entryDetail.innerHTML = `
        <h2>${entry.nom} ${entry.prenom}</h2>
        <p>Departments: ${entry.departements.join(', ')}</p>
        <div>${marked(entry.description)}</div>
        <a href="mailto:${entry.email}">${entry.email}</a>
    `;
        entryDetail.classList.remove('hidden');
    }

    fetchEntries();
});

