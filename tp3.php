<?php
require("tp3-helpers.php");
$id=400;
//chargement de la page de donnee du film de l'id choisis, en VO, VA et VF.
$filmvo=tmdbget('movie/'.$id);
$filmva=tmdbget('movie/'.$id,['language'=>'en']);
$filmvf=tmdbget('movie/'.$id,['language'=>'fr']);

//decodage des json pour utiliser les donnees
$decodevo=json_decode($filmvo,true);
$decodeva=json_decode($filmva,true);
$decodevf=json_decode($filmvf,true);

//inclusion du css pour rendre plus lisible le tableau
echo"<link rel='stylesheet' type='text/css' href='elements.css' />";

//ajout de l'ajout
echo "<img src=https://image.tmdb.org/t/p/w185".$decodevo['poster_path'].">";

//creation du tableau contenant les information
echo "<table><thead><tr><th></th>
	<th>VO</th>	<th>VA</th>	<th>VF</th>	</tr></thead><tbody>";
echo "<tr><th>titre</th>	<td>".$decodevo['title']."</td>	  <td>".$decodeva['title']."</td>   <td>".$decodevf['title']."</td><   /tr>";
echo '<tr><th>tagline</th><td>';  

if ($decodevo['tagline']!="")
	echo $decodevo['tagline']."</td><td>".$decodeva['tagline']."</td><td>".$decodevf['tagline']."</td></tr>";

echo '<tr><th>synopsis</th><td>'.$decodevo['overview']."</td><td>".$decodeva['overview']."</td><td>".$decodevf['overview']."</td></tr>";
echo "</tbody></table>";

//ajout du lien vers la page internet du film
if ($decodevo['homepage']!="")
	echo "lien: ".'<a href='.$decodevo['homepage'].'>'.$decodevo['homepage'].'</a>';
else
	 echo "aucun lien trouvé";

//ajout du lie vers le trailer
$search=tmdbget('movie/'.$id.'/videos');
$trailers=json_decode($search,true);
if(isset($trailers['results'][0])) echo '<br><a href= https://www.youtube.com/watch?v='.$trailers['results'][0]['key'].'>'."trailer du film"."</a>";
else echo "aucun trailer trouvé";
