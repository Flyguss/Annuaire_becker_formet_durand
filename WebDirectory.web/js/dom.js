// dom.js
export function showView(viewId) {
    const views = document.querySelectorAll('.view');
    views.forEach(view => view.classList.add('hidden'));
    document.getElementById(viewId).classList.remove('hidden');
}

export function displayEntries(entries, listId, sortEntries, displayEntryDetail) {
    const listElement = document.getElementById(listId);
    if (!listElement) {
        console.error(`Element with id ${listId} not found.`);
        return;
    }

    const sortedEntries = sortEntries([...entries]);
    const templateSource = document.getElementById('entries-template').innerHTML;
    const template = Handlebars.compile(templateSource);
    const html = template({ entries: sortedEntries });
    listElement.innerHTML = html;

    document.querySelectorAll(`#${listId} a`).forEach((link, index) => {
        link.setAttribute('data-id', sortedEntries[index].originalIndex);
        link.addEventListener('click', event => {
            event.preventDefault();
            const index = event.target.getAttribute('data-id');
            displayEntryDetail(entries[index]);
        });
    });
}

export function displayEntryDetail(entry) {
    const templateSource = document.getElementById('entry-detail-template').innerHTML;
    const template = Handlebars.compile(templateSource);
    const html = template({ ...entry});
    const detailContainer = document.getElementById('entry-detail');
    detailContainer.innerHTML = html;

    showView('entry-detail');
}
