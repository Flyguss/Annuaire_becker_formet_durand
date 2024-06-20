// app.js
import { fetchEntries } from './api.js';
import { showView, displayEntries, displayEntryDetail } from './dom.js';

let allEntries = [];
let currentSortOrder = 'asc';

document.addEventListener("DOMContentLoaded", () => {
    fetchEntries()
        .then(entries => {
            allEntries = entries;
            populateDepartments(allEntries);
            showView('department-view');
            displayEntries(allEntries, 'department-view-entries-list', sortEntries, displayEntryDetail);
        })
        .catch(error => console.error('Error fetching entries:', error));
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
        filterAndDisplayEntries();
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

function populateDepartments(entrees) {
    const departmentSelects = document.querySelectorAll('.department-select');
    const departments = new Set();

    entrees.forEach(entry => {
        entry.departements.forEach(department => {
            departments.add(department);
        });
    });

    departmentSelects.forEach(select => {
        departments.forEach(department => {
            const option = document.createElement('option');
            option.value = department;
            option.textContent = department;
            select.appendChild(option);
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
