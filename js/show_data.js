function get_data() {
    let title = document.getElementById('search_input').value;  
    fetch(`http://imdb.test/information.php?show=${title}`)
      .then(response => response.json())
      .then(response => console.log(response))
}

window.addEventListener('load', function () {
  document.getElementById('search_btn').addEventListener('click', get_data_test);
})

function get_data_test() {
  let title = document.getElementById('search_input').value;
  let url = `http://imdb.test/information.php?show=${title}`; // Where it gets the json  
  let xmlhttp = new XMLHttpRequest(), myMovies;

  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myMovies = JSON.parse(this.responseText).movies; // Return a JS object
      get_movies_data(myMovies);
    }
  };
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function get_movies_data(movies) {
  let movie_data, id_movie;
  
  for (id_movie in movies) {
    if (movies.hasOwnProperty(id_movie)) {
      create_movie_div(id_movie);
      movie_data = get_movie(movies[id_movie]);
      add_in_document(movie_data, id_movie); // Appends all movie data in a div from html
    }
  }
}

function create_movie_div(id) {
  var element, currentDiv;

  currentDiv = document.getElementById('movies');
  element = document.createElement('div');
  element.id = `movie_id_${id}`; // ID for assign after, when gets the information
  element.className = 'movie_format';
  currentDiv.appendChild(element);
}

function get_movie(movie) {
  var movie_obj = [];

  for (let type_data in movie) {
    if (movie.hasOwnProperty(type_data)) {
      movie_obj[type_data] = select_type_data(movie[type_data], type_data);
    }
  }
  return movie_obj;
}

function select_type_data(obj_type_data, key) {
  return key == 'movie_data' 
    ? add_movie_data(obj_type_data) 
    : key == 'directors' 
      ? `Directors: ${full_names(obj_type_data)} <br>` 
      : key == 'platforms'
        ? `Plataformes: ${one_field(obj_type_data)} <br>`
        : key == 'actors'
          ? `Actors: ${full_names(obj_type_data)} <br>`
          : `Gènere: ${one_field(obj_type_data)} <br>`;
    // Fer early return per cada funció que va a cridar, i després en l'altre mètode ja es sumara tot
}
// anar fent estructura if else if else, cada 'paquet de dades'(objecte) serà una funció
// cada funció afegeix les seves respectives dades a un String per mostrar-ho després al document.getElementById("movies").innerHTML
/******************************************************************************** */
// I al final fer una funció per cada apartat pel format en que es mostrarà
/******************************************************************************** */
        
function add_movie_data(object) {
  let property, result = '';
  
  for (property in object) {
    if (property !== 'movie_image') {
      result += `${object[property]}, `;
    }
  }

  return `${result} <br> ${show_image(object.movie_image)} <br>`;
}

function show_image(image) {
  return `<img src="${image}" alt="${image}">`
}

function one_field(object) {
  let result = '';

  if (Array.isArray(object.name)) {
    object.name.forEach(element => {
      result += `${element}, `;
    });
    return result;
  } else {
    return object.name;
  }
}

function full_names(object) {
  let result = '';
  object.forEach(element => {
    result += `${element.name} ${element.lastname}, `; 
  });
  return result;
}

/******************************************************************************************************
 * S'han de fer les funcions per aplicar el format correcte, crear elements i fer l'estructura 'html'
 ******************************************************************************************************/
function add_in_document(movie_obj, id) {
  for (const key in movie_obj) {
    if (movie_obj.hasOwnProperty(key)) {
      document.getElementById(`movie_id_${id}`).innerHTML += movie_obj[key]; 
    }
  }
}

/**********
 * Movie one function
 * Directos and actors use the same function for return data
 * Platforms and genres into other function, only return 1 column and directors return arrays of 2 columns
 */














// document.getElementById("movies").innerHTML = txt;

// Exemple
/* 
<h2>The XMLHttpRequest Object</h2>

<p>The getAllResponseHeaders() function returns all the header information of a resource, like length, server-type, content-type, last-modified, etc:</p>

<p id="demo"></p>

<script>
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("demo").innerHTML =
    this.getAllResponseHeaders();
  }
};
xhttp.open("GET", "ajax_info.txt", true);
xhttp.send();
</script>

And other (table format):

var obj, dbParam, xmlhttp, myObj, x, txt = "";
  obj = { table: "customers", limit: 20 };
  dbParam = JSON.stringify(obj);
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myObj = JSON.parse(this.responseText);
      txt += "<table border='1'>"
      for (x in myObj) {
        txt += "<tr><td>" + myObj[x].name + "</td></tr>";
      }
      txt += "</table>"    
      document.getElementById("demo").innerHTML = txt;
    }
  };
xmlhttp.open("POST", "json_demo_html_table.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("x=" + dbParam);

*/