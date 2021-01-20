<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trouve ta voiture</title>  
  <link href="style.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
<style>
  	/* Header Bar */
.header_bar {
  overflow: hidden;
  background-color: #ABABAB;
  position: fixed; /* Set the navbar to fixed position */
  top: 0; /* Position the navbar at the top of the page */
  left: 0;
  height: 10%;
  width: 100%; /* Full width */
}
/* End of Header Bar */
</style>
</head>
 <body>
  <div class="container">
   <br/>
   <br/>
   <br/>
   <!-- Header Bar -->
   <div class="header_bar">
   	<center><h1>/!\ Bonjour est bienvenue sur cette base de données /!\</h1></center>
</div>
<!-- End Of Header Bar-->
  <h2 align="center">Trouve ta voiture</h2><br /> <!-- Title -->
   <div class="form-group">
    <div class="row">
     <div class="col-md-9">
      <input type="text" id="tags" class="form-control" data-role="tagsinput" /> <!-- Initialisation des plugins -->
     </div>
     <div class="help" onclick="PopupHelp()">
     <img class="help" src="/assets/help.png" width="50" height="50" alt="" title="" />
     <span class="popuptext" id="myPopup">Entre un ou plusieurs tag(s) dans la barre de recherche</span>
 </div>
     <div class="col-md-2">
      <button type="button" name="search" class="btn btn-primary" id="search">Search</button>
      <button type="button"  class="btn btn-primary" onClick="refreshPage()">Reset</button>
     </div>
    </div>
   </div>
   <br />
   <div class="table-responsive">
    <div align="right">
     <p><b>Total Records - <span id="total_records"></span></b></p>
    </div>
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>Image</th>
       <th>Modèle</th>
       <th>Marque</th>
       <th>Catégorie</th>
       <th>Année</th>
       <th>Cylindrée</th>
       <th>Accélération (0 à 100 km/h)</th>
       <th>En Savoir Plus</th>
      </tr>
     </thead>
     <tbody>
     </tbody>
    </table>
   </div>
  </div>
  <div style="clear:both"></div>
  <br/>
  <br/>
  <br/>
  <br/>
  <footer>
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <b>Hugo Lalet</b>
  </div>
</footer>
 </body>
</html>

<script>
$(document).ready(function(){
 
 load_data();
/*load the data from sql to website*/
 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   dataType:"json",
   success:function(data)
   {
    $('#total_records').text(data.length);
    var html = '';
    var count = 0;
    if(data.length > 0)
    {
     while(count < data.length)
     {
      html += '<tr>';
      html += '<td><img src="/assets/'+data[count].Image+'" width="150" height="100"></td>;'
      html += '<td>'+data[count].Modèle+'</td>';
      html += '<td>'+data[count].Marque+'</td>';
      html += '<td>'+data[count].Catégorie+'</td>';
      html += '<td>'+data[count].Année+'</td>';
      html += '<td>'+data[count].Cylindrée+'</td>';
      html += '<td>'+data[count].Accélération+'</td>';
      html += '<td><a href="'+data[count].Ensavoirplus+'"target="_blank">En savoir plus</a></td></tr>';
      count = count + 1;
     }
    } else {
     html = '<tr><td colspan="5">No Data Found</td></tr>';
    }
    $('tbody').html(html);
   }
  })
 }
/*use tag to filter*/
 $('#search').click(function(){
  var query = $('#tags').val();
  load_data(query);
 });

});
/*To refresh the page*/
function refreshPage(){
    window.location.reload();
}
/*display the Helper*/
function PopupHelp() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}

</script>