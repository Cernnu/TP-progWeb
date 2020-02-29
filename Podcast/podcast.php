<?php
require_once('vendor/dg/rss-php/src/Feed.php');
//acces a la base de donnee
$rss = Feed::loadRss('http://radiofrance-podcast.net/podcast09/rss_14312.xml');
//affichage du recapitulatif de l'emission
echo "Titre : \n ", $rss->title;
echo "\nDescription: \n ", $rss->description;
echo "\nLien:\n  ", $rss->link, "\n";
//creation du tableau
echo"<table>
		<thead>
			<tr>
				<th>Date</th>
				<th>Titre</th>
				<th>Lecture</th>
				<th>Durée</th>
				<th>Média</th>
</tr></thead><tbody>";


//remplisage du tableau
foreach ($rss->item as $item) {
	$Date=$item->pubDate;
	$titre= $item->title." \n";
	$lien=$item->link;
	$media= $item->enclosure['url'];
	$duree= $item->{'itunes:duration'};
	//affichage du tableau
	echo "<tr><td>$Date</td>
		<td><a href=".$lien.">$titre</a></td>
		<td><audio controls='controls'><source src=$media type='audio/mp3'/></audio></td>
		<td>$duree</td>
		<td><a href=".$media.">$media</td></tr>";
}
