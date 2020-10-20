// window.addEventListener('load', function () {
//     document.getElementById('search_btn').addEventListener('click', get_data);
// })
window.onload = function()
{
    fetch('http://imdb.test/information.php?genres')
      .then(function(response){ return response.json(); })
      .then(function(json){ addGenres(json); });
    
    // get_data();
}

function addGenres(json)
{
    for (const genres of json) {
        var genre = createGenre(genres['nom']);
        var genreLabel = createLabel(genres['nom']);
        var appendTo = document.getElementById('genres'); // Place where append to
        appendTo.appendChild(genre);
        appendTo.appendChild(genreLabel);
    }
}

function createGenre(name)
{
    var genre = document.createElement('input');
    genre.type = 'checkbox';
    genre.value = genre.id = genre.name = name;
    return genre;
}

function createLabel(name)
{
    var label = document.createElement('label');
    label.innerHTML = name;
    label.setAttribute('for', name);
    return label;
}

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