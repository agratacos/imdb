function get_data() {
    let title = document.getElementById('search_input').value;  
    fetch(`http://imdb.test/information.php?show=${title}`)
      .then(response => response.json())
      .then(response => console.log(response))
}

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
      // document.getElementById("movies").innerHTML = 'hola';
      create_movie_div(id_movie);
      movie_data = get_movie(movies[id_movie]);
      // document.getElementById("movies").innerHTML = movie_data;
      // add_in_document(); // Appends all movie data in a div from html
    }
  }
}

function create_movie_div(id) {
  var element = document.createElement('div');
  element.id = `movie_id_${id}`; // ID for assign after, when gets the information
  element.className = 'movie_format';
  document.body.appendChild(element);
}

function get_movie(movie) { // Arriba bé
  for (let type_data in movie) {
    if (movie.hasOwnProperty(type_data)) {
      select_type_data(movie[type_data], type_data);
    }
  }
}

function select_type_data(type_data, key) { // Arriba l'array amb les dades concretes de l'apartat
  key == 'movie_data' 
    ? add_movie_data(type_data)
    : key == 'directors' 
      ? fields_in_array(type_data) 
      : key == 'platforms'
        ? one_field(type_data)
        : key == 'actors'
          ? fields_in_array(type_data)
          : one_field(type_data);
}
// anar fent estructura if else if else, cada 'paquet de dades'(objecte) serà una funció
// cada funció afegeix les seves respectives dades a un String per mostrar-ho després al document.getElementById("movies").innerHTML
        
function add_movie_data(object) {
  let property, result = '';
  
  for (property in object) {
    result += `${object[property]}, `;
  }

  // document.getElementById("movies").innerHTML = test();

  document.getElementById(`movie_id_${object.id_movie}`).innerHTML += `${result} <br> ${show_image(object.movie_image)} <br>`;
  // return result;
}

function test() {
  var title = document.createElement('h3');
  title.innerHTML = 'aixo es una prova';
  return title;
}

function show_image(image) {
  return `<img src="${image}" alt="">`
}

function one_field(object) {
  
}

function fields_in_array(object) {
  
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