<body>
	<h1>Bienvenue <?php echo $title; ?></h1>
	<p>Vous avez aucun quizz. Veuillez cliquez sur le bouton Ajouter pour en créer un.</p>
	<table>
		<thead>
			<td>Titre</td>
			<td>Statut</td>
			<td>Date de création</td>
		</thead>
	<?php foreach ($ as $) { ?>
		<tr>
			<td><?php echo $['']; ?></td>
			<td><?php echo $['']; ?></td>
			<td><?php echo $['']; ?></td>
		</tr>
	<?php } ?>
	</table>
	<?=anchor('quizz/'.$clef.'', 'Ajouter une quizz ➕')?>
</body>