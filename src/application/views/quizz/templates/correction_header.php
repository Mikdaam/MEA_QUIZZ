<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Correction du quizz</title>
	<?=link_tag('css/style_quizzcorrection')?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div id="container">
	<p align="center"><?=anchor('accueil/', 'Retour à l\'accueil', array('class'=>'deconnexion'))?></p>
<form class="score">
    <h2>Score</h2>
    <div class="ligne3"></div>
    <a class="pourcentage">Pourcentage de bonne notes : </a><a class="monscore"><?php $score ?></a>
</form>