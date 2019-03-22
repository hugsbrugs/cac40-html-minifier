<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CAC 40 Minified Home Page Compression Test</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
	<h1 class="text-center mt-5">Test de minification HTML des pages d'accueil du CAC 40</h1>
	<div class="jumbotron">
		<p>J'ai téléchargé et compressé le HTML des pages d'accueil des sites web du CAC 40 pour voir si ces grandes entreprises optimisent ces ressources à l'heure des économies d'énergies.</p>
		<p>Nous avons un groupe de tête (1 à 5%) avec Vinci, Unibail, Total, Schneider Electric, Sanofi, Publicis, Michelin, Engie, Accord Hotels et Arcelor Mittal. Pour la plupart des groupes liés à l'énergie et qui ont pris conscience qu'il était simple d'optimiser son HTML.</p>
		<p>Vient un second groupe (5 à 15%): Vivendi, Veolia, Saint Gobain, Safran, Pernod Ricard, Groupe PSA, Crédit Agricole, Carrefour, Bouygues, Axa, Air Liquide, Airbus, Renault. Ce groupe a pris conscience de la nécessité de compresser le HTML mais sans aller jusqu'au bout du processus.</p>
		<p>Puis un dernier groupe qui n'a pas pris conscience que ça serait bon pour eux et pour l'environnement de compresser leur HTML !</p>
		<p>Et vous compressez-vous votre code ?</p>
		<p class="text-center">
			<a href="#pourquoi" title="Pourquoi Minifier" class="btn btn-lg btn-success">Voir si dessous pourquoi compresser son HTML !</a>
		</p>
	</div>

	<p>Voir le code et le script de minification sur github</p>
	<p>Résultats du test (22/03/2019)</p>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Company</th>
				<th>Home Page Size</th>
				<th>Home Page Size Min</th>
				<th>Reduction</th>
			</tr>
		</thead>
	<?php
	// $dir_base = __DIR__ . '/html/';
	// $dir_min = __DIR__ . '/html-min/';
	$dir_base = __DIR__ . '/html-2019-03-22/';
	$dir_min = __DIR__ . '/html-2019-03-22-min/';
	$files = scandir($dir_base);
	foreach ($files as $key => $file)
	{
		echo '<tr>';
		if($file!=='.' && $file!=='..')
		{
			$name = str_replace(['www.','.com','.html'], ['','',''], $file);
			$weight = filesize($dir_base.$file);
			$weight_min = filesize($dir_min.$file);
			$reduction = ($weight-$weight_min)/$weight*100;
			$reduction = ($weight_min-$weight)/$weight*100;
			echo '<td>'.ucfirst($name).'</td>';
			echo '<td><a href="https://github.com/hugsbrugs/cac40-html-minifier/blob/master/'.basename($dir_base).'/'.$name.'.html" target="_blank" title="Version non Minifiée">'.$weight.'</a></td>';
			echo '<td><a href="https://github.com/hugsbrugs/cac40-html-minifier/blob/master/'.basename($dir_min).'/'.$name.'.html" target="_blank" title="Version Minifiée">'.$weight_min.'</a></td>';
			echo '<td>'.round($reduction).' %</td>';
		}
		echo '</tr>';
	}
	?>
	</table>

	<h2 id="pourquoi">Pourquoi minifier le HTML ?</h2>
	
	<h3>1. Pour réduire la taille de vos pages</h3>
	
	<h4>Accélereration de la vitesse de chargement de vos pages</h4>
	<h5>=> Amélioration de l'expérience utilisateur</h5>
	<h5>=> Amélioration de votre référencement (SEO)</h5>
	
	<h3>2. Diminuer la quantité de données échangées sur le réseau</h3>
	<h4>Optimisation de la dépense d'énergie</h4>

	<p>La réponse des techniciens sur <a href="https://stackoverflow.com/questions/1306792/why-people-minify-assets-and-not-the-html#answer-22446770" target="_blank" title="Why minify ?">stackoverflow.com</a></p>
	
	<h2>Les outils de test</h2>

	<p>Testez la rapidité de votre site web avec l'outil <a href="https://developers.google.com/speed/pagespeed/insights/?hl=fr" target="_blank" title="Page Speed Insights">Google Page Speed Insights</a></p>

	<p>Vous utilisez Wordpress ? Essayez le plugin <a href="https://fr.wordpress.org/plugins/minify-html-markup/#description" target="_blank" title="Plugin Wordpress minify-html-markup">minify-html-markup</a></p>

	<div class="jumbotron">
		<h4 class="text-center">Besoin d'aide pour mettre en place votre script de minification,<br> ou une stratégie complète de compression ?</h4>
		<p class="text-center">
			<a href="https://hugo.maugey.fr/contact" title="Contact Hugo Maugey Webmaster" class="btn btn-lg btn-secondary">Contactez-moi !</a>
		</p>
	</div>
</div>
</body>
</html>
