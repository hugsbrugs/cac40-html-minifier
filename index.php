<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CAC 40 Minified Home Page Compression Test</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta name="description" content="Test de minification HTML des pages d'accueil des sites internet du CAC 40">
	<!-- Open Graph -->
    <meta property="og:title" content="Et vous ? Vous minifiez votre HTML ?" />
    <meta property="og:description" content="Test de minification HTML des pages d'accueil des sites internet du CAC 40" />
    <meta property="og:image" content="https://hugsbrugs.github.io/cac40-html-minifier/compress.jpg" />
	<meta property="og:image:width" content="1024">
	<meta property="og:image:height" content="768">
	<meta property="og:url" content="https://hugsbrugs.github.io/cac40-html-minifier/">
	<meta property="og:site_name" content="Test CAC 40 HTML Minification" />
	<meta property="og:type" content="article" />
	<meta property="og:locale" content="fr_FR" />
</head>
<body>
<div class="container">
	<h1 class="text-center mt-5">Test de minification HTML des pages d'accueil du CAC 40</h1>
	<div class="jumbotron">
		<p>J'ai téléchargé et compressé le HTML des pages d'accueil des sites web du CAC 40 pour voir si ces grandes entreprises optimisent ces ressources à l'heure des économies d'énergies.</p>
		<p>Nous avons un groupe de tête (1 à 5%) avec Vinci, Véolia, Unibail, Total, Schneider Electric, Michelin, Engie et Accord Hotels. Pour la plupart des groupes liés à l'énergie et qui ont pris conscience qu'il était simple d'optimiser son HTML.</p>
		<p>Vient un second groupe (6 à 15%): Vivendi, Sanofi, Saint Gobain, Safran, Renault, Groupe PSA, Dassault, Carrefour, Cap Gemini, Bouygues, Axa, Arcelor Mittal et Air Liquide. Ce groupe a pris conscience de la nécessité de compresser le HTML mais sans aller jusqu'au bout du processus.</p>
		<p>Puis un dernier groupe qui n'a pas pris conscience que ça serait bon pour eux et pour l'environnement de compresser leur HTML !</p>
		<p>Et vous compressez-vous votre code ?</p>
		<p class="text-center">
			<a href="#pourquoi" title="Pourquoi Minifier" class="btn btn-lg btn-success">Voir si dessous pourquoi compresser son HTML !</a>
		</p>
	</div>

	<p>Voir le code et le script de minification sur <a href="https://github.com/hugsbrugs/cac40-html-minifier" title="Projet sur Github">github</a></p>
	<p>Cliquer sur les poids des pages pour voir les versions compressées et non compressées (en 2019 seul le HTML était compressé dans ce test. En 2020 le Javascript et le CSS contenus directement dans la page sont aussi compressés mais pas les fichiers externes).</p>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Entreprise</th>
				<th>Poids Home Page<br>22-03-2019</th>
				<th>Poids Home Page Minifiée<br>22-03-2019</th>
				<th>Réduction Possible<br>22-03-2019</th>
				<th>Poids Home Page<br>26-05-2020</th>
				<th>Poids Home Page Minifiée<br>26-05-2020</th>
				<th>Réduction Possible<br>26-05-2020</th>
			</tr>
		</thead>
	<?php

	function human_filesize($size, $precision = 2) {
	    $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
	    $step = 1024;
	    $i = 0;
	    while (($size / $step) > 0.9) {
	        $size = $size / $step;
	        $i++;
	    }
	    return round($size, $precision).$units[$i];
	}

	$companies = json_decode(file_get_contents(__DIR__.'/cac40.json'));

	// $dir_base = __DIR__ . '/html/';
	// $dir_min = __DIR__ . '/html-min/';
	$dir_base_1 = __DIR__ . '/html-2019-03-22/';
	$dir_min_1 = __DIR__ . '/html-2019-03-22-min/';
	$dir_base_2 = __DIR__ . '/html-2020-05-26/';
	$dir_min_2 = __DIR__ . '/html-2020-05-26-min/';
	$files = scandir($dir_base_1);
	foreach ($files as $key => $file)
	{
		echo '<tr>';
		if($file!=='.' && $file!=='..')
		{
			$name = str_replace(['www.','.com','.html'], ['','',''], $file);
			# 2019
			$weight_1 = filesize($dir_base_1.$file);
			$weight_min_1 = filesize($dir_min_1.$file);
			$reduction_1 = ($weight_min_1-$weight_1)/$weight_1*100;
			# 2020
			$weight_2 = filesize($dir_base_2.$file);
			$weight_2_1 = round(($weight_2-$weight_1)/$weight_1*100);
			$weight_min_2 = filesize($dir_min_2.$file);
			$reduction_2 = ($weight_min_2-$weight_2)/$weight_2*100;

			echo '<td><a href="'.$companies->$name.'" target="_blank" rel="nofollow" title="Page d\'accueil '.$name.'">'.ucfirst($name).'</a></td>';
			
			# 2019
			echo '<td><a href="https://github.com/hugsbrugs/cac40-html-minifier/blob/master/'.basename($dir_base_1).'/'.$name.'.html" target="_blank" title="Version non Minifiée">'.human_filesize($weight_1).'</a></td>';
			echo '<td><a href="https://github.com/hugsbrugs/cac40-html-minifier/blob/master/'.basename($dir_min_1).'/'.$name.'.html" target="_blank" title="Version Minifiée">'.human_filesize($weight_min_1).'</a></td>';
			echo '<td>'.round($reduction_1).' %</td>';

			# 2020
			echo '<td><a href="https://github.com/hugsbrugs/cac40-html-minifier/blob/master/'.basename($dir_base_2).'/'.$name.'.html" target="_blank" title="Version non Minifiée">'.human_filesize($weight_2).'</a><br>'.$weight_2_1.' % / 2019</td>';
			echo '<td><a href="https://github.com/hugsbrugs/cac40-html-minifier/blob/master/'.basename($dir_min_2).'/'.$name.'.html" target="_blank" title="Version Minifiée">'.human_filesize($weight_min_2).'</a></td>';
			echo '<td>'.round($reduction_2).' %</td>';
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

	<p>Testez la rapidité de votre site web avec <a href="https://developers.google.com/speed/pagespeed/insights/?hl=fr" target="_blank" title="Page Speed Insights">Google Page Speed Insights</a></p>

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
