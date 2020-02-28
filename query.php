<?php
require("tp3-helpers.php");
$filmvo=tmdbget('search/movie',['query'=>"Lord of the Ring"]);
$decodevo=json_decode($filmvo,true);
$len=$decodevo["total_results"];
for ($i=0;$i<$len;$i++){
	if ($decodevo['results'][$i]["id"]<=1000) print($decodevo['results'][$i]["original_title"]."<br>");
}

for ($i=0;$i<$len;$i++){
	if ($decodevo['results'][$i]["id"]<=1000){
		print("<br>".$decodevo['results'][$i]["title"].":<br>");
		$casting=tmdbget('movie/'.$decodevo['results'][$i]["id"].'/credits');
		$clearcast=json_decode($casting,true);
		//var_dump($clearcast);
		$cpt=0;
		while(isset($clearcast['cast'][$cpt])){
			$acteur=tmdbget('credit/'.$clearcast['cast'][$cpt]['credit_id']);
			$clearact=json_decode($acteur,true);
			//var_dump($clearact);
			$number=0;
			while(isset($clearact['person']['known_for'][$number]))$number++;
			print("nom:	".'<a href=liste_films.php?id='.$clearact['person']['id'].'>'.$clearcast['cast'][$cpt]['name']."</a> role: ".$clearcast['cast'][$cpt]['character']." nb de roles: ".$number."<br>");
			$cpt++;
		}
	}
}
