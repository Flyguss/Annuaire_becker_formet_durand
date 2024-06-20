const API_BASE_URL = 'http://localhost:42064/api';

function handleResponse(response) {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
}

export function fetchEntries() {
    return fetch(`${API_BASE_URL}/entrees`)
        .then(handleResponse)
        .then(data => {
            if (Array.isArray(data.entres)) {
                return data.entres;
            } else {
                throw new Error('API did not return an array of entries');
            }
        });
}

export function fetchDepartments() {
    return fetch(`${API_BASE_URL}/services`)
        .then(handleResponse)
        .then(data => {
            if (Array.isArray(data.departements)) {
                return data.departements.map(item => item.departement); // Extraire les départements de chaque item
            } else {
                throw new Error('API did not return an array of departments');
            }
        });
}



export function fetchEntriesByDepartment(departmentId) {
    return fetch(`${API_BASE_URL}/services/${departmentId}/entrees`)
        .then(handleResponse)
        .then(data => {
            if (Array.isArray(data.entres)) {
                return data.entres;
            } else {
                throw new Error('API did not return an array of entries');
            }
        });
}

export function searchEntriesByName(query) {
    return fetch(`${API_BASE_URL}/entrees/search?q=${encodeURIComponent(query)}`)
        .then(handleResponse)
        .then(data => {
            if (Array.isArray(data.entres)) {
                return data.entres;
            } else {
                throw new Error('API did not return an array of entries');
            }
        });
}

export function fetchEntryById(entryId) {
    return fetch(`${API_BASE_URL}/entrees/${entryId}`)
        .then(handleResponse)
        .then(data => {
            if (data && data.id) {
                return data;
            } else {
                throw new Error('API did not return a valid entry');
            }
        });
}
