<?php
require("tp3-helpers.php");
$filmvo=tmdbget('search/movie',['query'=>"Lord of the Ring"]);
$decodevo=json_decode($filmvo,true);
$len=$decodevo["total_results"];
for ($i=0;$i<$len;$i++){
	if ($decodevo['results'][$i]["id"]<=1000) print($decodevo['results'][$i]["original_title"]."\n");
}

for ($i=0;$i<$len;$i++){
	if ($decodevo['results'][$i]["id"]<=1000){
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
			print("nom: ".$clearcast['cast'][$cpt]['name']." role: ".$clearcast['cast'][$cpt]['character']." nb de roles: ".$number."\n");
			$cpt++;
		}
	}
}
