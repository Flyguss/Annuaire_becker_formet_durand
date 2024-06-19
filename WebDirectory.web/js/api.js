//api.js
export function fetchEntries() {
    return fetch('http://localhost:42064/api/entrees')
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data.entres)) {
                return data.entres;
            } else {
                throw new Error('API did not return an array of entries');
            }
        });
}
