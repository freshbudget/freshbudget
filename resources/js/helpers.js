/**
 * Navigate to a new page
 * 
 * @param {string} to
 */
window.navigate = (to) => {
    window.location.href = to
}

/**
 * Sync UI state with server
 * 
 * @param {string} key
 * @param {object} body
 * @returns {void}
 */
window.syncUIState = function(key, value) {
    fetch('/cookies/' + key, {
        method: 'POST',
        body: JSON.stringify({open: value}),
    });
}