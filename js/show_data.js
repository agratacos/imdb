function get_data() {
    let title = document.getElementById('search_input').value;  

    fetch(`http://imdb.test/information.php?show=${title}`)
      .then(response => response.json())
      .then(response => console.log(response))
}