<?php
//version ligne de commande


require("tp3-helpers.php");
//recherche de la liste des films portant "Lord of the Ring"
$filmvo=tmdbget('search/movie',['query'=>"Lord of the Ring"]);
//decodage
$decodevo=json_decode($filmvo,true);
//recuperation des resultat
$len=$decodevo["total_results"];
for ($i=0;$i<$len;$i++){
	if ($decodevo['results'][$i]["id"]<=1000) //en regardannt l'id on remarque que celle des documentaire sont tous au dessus de 1000 par rapport aux films originaux qui sont en dessous de cette valeur
 print($decodevo['results'][$i]["original_title"]."\n");
}

//boucle for tournant autant de fois que de films trouvés
for ($i=0;$i<$len;$i++){
	if ($decodevo['results'][$i]["id"]<=1000){
		$casting=tmdbget('movie/'.$decodevo['results'][$i]["id"].'/credits');
		//récuperation du casting du film
		$clearcast=json_decode($casting,true);
		$cpt=0;
		//boucle affichant les acteur du film avec leur nombre de role dans la trilogie.
		while(isset($clearcast['cast'][$cpt])){
			$acteur=tmdbget('credit/'.$clearcast['cast'][$cpt]['credit_id']);
			$clearact=json_decode($acteur,true);
			$number=0;
			while(isset($clearact['person']['known_for'][$number]))$number++;
			//lien rebond vers la liste des films de l'acteur.
			print("nom: ".$clearcast['cast'][$cpt]['name']." role: ".$clearcast['cast'][$cpt]['character']." nb de roles: ".$number."\n");
			$cpt++;
		}
	}
}
