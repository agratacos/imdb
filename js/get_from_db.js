window.onload = function()
{    
    get_data();
}

function get_data() 
{
    from_platforms();
    from_genres();
}

function from_platforms() 
{
    fetch('http://imdb.test/information.php?platform')
        .then(function(response){ return response.json(); })
        .then(function(json){ addCheckbox(json, 'platforms'); });
}

function from_genres() 
{
    fetch('http://imdb.test/information.php?genre')
        .then(function(response){ return response.json(); })
        .then(function(json){ addCheckbox(json, 'genres'); }); // 
}

function addCheckbox(json, id_name_in_html)
{
    for (const elements of json) {
        var element = createInput(elements['name']);
        var elementLabel = createLabel(elements['name']);
        var appendTo = document.getElementById(id_name_in_html); // Place where append to
        appendTo.appendChild(element);
        appendTo.appendChild(elementLabel);
    }
}

function createInput(name)
{
    var input = document.createElement('input');
    input.type = 'checkbox';
    input.value = input.id = name;
    input.name = `${name}[]`; // For after get elements in a array, for insert into DB
    return input;
}

function createLabel(name)
{
    var label = document.createElement('label');
    label.innerHTML = name;
    label.setAttribute('for', name);
    return label;
}