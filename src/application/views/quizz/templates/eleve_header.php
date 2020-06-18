<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="<?php echo $time*60; ?>;URL=<?php echo site_url("accueil/index"); ?>">
	<title><?php echo $title; ?></title>
	<?=link_tag('css/'.$style.'')?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="timer">
        <ul>
        	<li>Fin du quizz dans </li>
            <li id="countdown_hour"></li>
            <li>heure(s)</li>
            <li id="countdown_min"></li>
            <li>min(s)</li>
            <li id="countdown_sec"></li>
            <li>sec(s)</li>
        </ul>
    </div>