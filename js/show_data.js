function get_data() {
    let title = document.getElementById('search_input').value;  
    fetch(`http://imdb.test/information.php?show=${title}`)
      .then(response => response.json())
      .then(response => console.log(response))
}

function get_data_test() {
  let title = document.getElementById('search_input').value;
  let url = `http://imdb.test/information.php?show=${title}`; // Where it gets the json
  let movies;  
  
  var xmlhttp = new XMLHttpRequest(), myMovies;
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myMovies = JSON.parse(this.responseText).movies; // Return a JS object
      // console.log(myMovies);
      get_movies_data(myMovies);
      // document.getElementById("movies").innerHTML = myArr;
    }
  };
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

  function get_movies_data(movies) {
    for (const id_movie in movies) {
      if (movies.hasOwnProperty(id_movie)) {
        get_movie(movies[id_movie]);
      }
    } 
  }

  function get_movie(movie) {
    for (const type_data in movie) {
      if (movie.hasOwnProperty(type_data)) {
        select_type_data(movie[type_data]);
      }
    }
  }

  function select_type_data(type_data) {
    // type_data == 'movie_data' 
    //   ? add_movie_data()
    //   : type_data == 'directors' ? add_directors() .....
        // anar fent estructura if else if else, cada 'paquet de dades'(objecte) serà una funció
  }
 
  // fetch(url)
  //     .then(response => response.json())
  //     .then(response => console.log(response));
  // xhttp.send();
}

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