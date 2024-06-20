import {
    fetchEntries,
    fetchDepartments,
    searchEntriesByName,
} from './api.js';
import { showView, displayEntries, displayEntryDetail } from './dom.js';

let allEntries = [];
let currentSortOrder = 'asc';

document.addEventListener("DOMContentLoaded", () => {
    fetchDepartments()
        .then(departments => {
            populateDepartments(departments);
            fetchEntries()
                .then(entries => {
                    allEntries = entries;
                    showView('department-view');
                    displayEntries(allEntries, 'department-view-entries-list', sortEntries, displayEntryDetail);
                })
                .catch(error => console.error('Error fetching entries:', error));
        })
        .catch(error => console.error('Error fetching departments:', error));

    setupEventListeners();
});

function setupEventListeners() {
    document.getElementById('btn-department').addEventListener('click', () => {
        showView('department-view');
        filterAndDisplayEntries();
    });

    document.getElementById('btn-search').addEventListener('click', () => {
        showView('search-view');
        filterAndDisplayEntries();
    });

    document.getElementById('btn-combined-search').addEventListener('click', () => {
        showView('combined-search-view');
        filterAndDisplayEntries();
    });

    document.getElementById('department-select').addEventListener('change', () => {
        filterAndDisplayEntries();
    });

    document.getElementById('name-search').addEventListener('input', () => {
        const query = document.getElementById('name-search').value;
        if (query) {
            searchEntriesByName(query)
                .then(entries => displayEntries(entries, 'search-view-entries-list', sortEntries, displayEntryDetail))
                .catch(error => console.error('Error searching entries by name:', error));
        } else {
            fetchEntries()
                .then(entries => {
                    allEntries = entries;
                    displayEntries(allEntries, 'search-view-entries-list', sortEntries, displayEntryDetail);
                })
                .catch(error => console.error('Error fetching entries:', error));
        }
    });

    document.getElementById('combined-department-select').addEventListener('change', () => {
        filterAndDisplayEntries();
    });

    document.getElementById('combined-name-search').addEventListener('input', () => {
        filterAndDisplayEntries();
    });

    document.getElementById('btn-back').addEventListener('click', () => {
        showView('department-view');
        filterAndDisplayEntries();
    });

    document.getElementById('sort-order').addEventListener('change', (event) => {
        currentSortOrder = event.target.value;
        filterAndDisplayEntries();
    });
}


function filterAndDisplayEntries() {
    const currentViewId = document.querySelector('.view:not(.hidden)').id;
    let filteredEntries = allEntries;

    if (currentViewId === 'department-view') {
        const selectedDepartment = document.getElementById('department-select').value;
        filteredEntries = selectedDepartment ?
            allEntries.filter(entry => entry.departements.includes(selectedDepartment)) :
            allEntries;
    } else if (currentViewId === 'search-view') {
        const searchText = document.getElementById('name-search').value.toLowerCase();
        filteredEntries = searchText ?
            allEntries.filter(entry =>
                entry.nom.toLowerCase().includes(searchText) ||
                entry.prenom.toLowerCase().includes(searchText)
            ) :
            allEntries;
    } else if (currentViewId === 'combined-search-view') {
        const selectedDepartment = document.getElementById('combined-department-select').value;
        const searchText = document.getElementById('combined-name-search').value.toLowerCase();
        filteredEntries = allEntries.filter(entry => {
            const matchesDepartment = selectedDepartment ? entry.departements.includes(selectedDepartment) : true;
            const matchesName = searchText ?
                entry.nom.toLowerCase().includes(searchText) ||
                entry.prenom.toLowerCase().includes(searchText) : true;
            return matchesDepartment && matchesName;
        });
    }

    displayEntries(filteredEntries, `${currentViewId}-entries-list`, sortEntries, displayEntryDetail);
}


function populateDepartments(departments) {
    const departmentSelects = document.querySelectorAll('.department-select');

    departmentSelects.forEach(select => {
        select.innerHTML = ''; // Vider les options actuelles

        // Ajouter une option vide pour permettre la sélection de tous les départements
        const emptyOption = document.createElement('option');
        emptyOption.value = '';
        emptyOption.textContent = 'Select a Department';
        select.appendChild(emptyOption);

        departments.forEach(department => {
            const option = document.createElement('option');
            option.value = department.nom; // Utiliser le nom du département comme valeur
            option.textContent = department.nom;
            select.appendChild(option);
        });

        // Ajouter un écouteur d'événement change pour chaque sélecteur après le remplissage
        select.addEventListener('change', () => {
            filterAndDisplayEntries();
        });
    });
}


function sortEntries(entries) {
    return entries.map((entry, index) => ({
        ...entry,
        originalIndex: index
    })).sort((a, b) => {
        const nameA = `${a.nom} ${a.prenom}`.toLowerCase();
        const nameB = `${b.nom} ${b.prenom}`.toLowerCase();
        if (currentSortOrder === 'asc') {
            return nameA < nameB ? -1 : (nameA > nameB ? 1 : 0);
        } else {
            return nameA > nameB ? -1 : (nameA < nameB ? 1 : 0);
        }
    });
}
