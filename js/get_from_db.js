// window.addEventListener('load', function () {
//     document.getElementById('search_btn').addEventListener('click', get_data);
// })

function get_data() {
    from_platforms();
    from_genres();
}

function from_platforms() { // Get data from an url, need filter
    
    new_label();
    new_checkbox('platforms');
}

function from_genres() { // Get data from an url, need filter

    new_label();
    new_checkbox('genres');
}

function get_paragraph(type) { // type is 'platforms' or 'genres'
    return document.getElementById(type); 
}

function new_label(type, id_name) {
    get_paragraph(type).innerHTML = `<label for="${id_name}">${id_name}</label>`;
}

function new_checkbox(type, value) {    
    get_paragraph(type).innerHTML = `<input type="checkbox" name="${type}[]" value="${value}"> `;
}