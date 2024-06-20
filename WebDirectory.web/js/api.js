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
                return data.departements.map(item => item.departement);
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
            if (data && data.entre) {
                return data.entre;
            } else {
                throw new Error('API did not return a valid entry');
            }
        });
}


export function searchEntriesByNameAndDepartment(query, departmentId) {
    return Promise.all([
        searchEntriesByName(query),
        fetchEntriesByDepartment(departmentId)
    ])
        .then(([nameResults, departmentResults]) => {
            const combinedResults = nameResults.filter(entry =>
                departmentResults.some(deptEntry => deptEntry.links.self.href === entry.links.self.href)
            );
            return combinedResults;
        })
        .catch(error => {
            console.error('Error during combined search:', error);
            throw error;
        });
}
