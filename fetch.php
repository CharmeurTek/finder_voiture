<?php

/*ID Config*/
$dsn = 'mysql:host=localhost;dbname=web';
$host = 'localhost';
$dbname = 'web';
$user = 'root';
$password = '';
/*Config Finish*/
$connect = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

$query = '';
/*Searcher*/
if(isset($_POST["query"]))
{
 $search = str_replace(",", "|", $_POST["query"]);
 $query = "
 SELECT * FROM cars 
 WHERE Modèle REGEXP '".$search."' 
 OR Marque REGEXP '".$search."' 
 OR Catégorie REGEXP '".$search."' 
 OR Année REGEXP '".$search."' 
 OR Cylindrée REGEXP '".$search."'
 ";
} else {
 $query = "SELECT * FROM cars ORDER BY CustomerID"; // Trier par
}
/*End of Searcher*/
/*Display the result*/
$statement = $connect->prepare($query);
$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
 $data[] = $row;
}
echo json_encode($data);
/*End of display*/
?>