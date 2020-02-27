<?php
require("tp3-helpers.php");
$filmvo=tmdbget('search/movie',['query'=>"Lord of the Ring"]/*,['language'=>'fr']*/);
$decodevo=json_decode($filmvo,true);
//var_dump($decodevo);
$len=$decodevo["total_results"];
for ($i=0;$i<$len;$i++){
	print($decodevo['results'][$i]["original_title"].' '.$decodevo['results'][$i]["id"].' '.$decodevo['results'][$i]["release_date"]."\n");
}
