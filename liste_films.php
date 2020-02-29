<?php
// page affichant la liste des film d'un acteur dont l'id est rentrée en parametre
require("tp3-helpers.php");
$id=$_GET['id'];
$films=tmdbget('person/'.$id.'/movie_credits');
$clearf=json_decode($films,true);
$cpt=0;
while(isset($clearf['cast'][$cpt])){
	echo "film: ".$clearf['cast'][$cpt]['title']." role: ".$clearf['cast'][$cpt]['character']."<br>";
	$cpt++;
}
