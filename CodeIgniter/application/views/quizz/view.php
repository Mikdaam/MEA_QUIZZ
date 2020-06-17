<body>
	<h1><?php echo $title; ?></h1>
	<?php 
		if ($nb_question < 2) {
			echo '<p>Ce quizz comporte actuellement '.$nb_question.' question.</p>';
		}else
			echo '<p>Ce quizz comporte actuellement '.$nb_question.' questions.</p>';
		$etat = 'Actif';
	?>
	<?=anchor('quizz/activer_quizz/'.$clef.'/'.$etat.'', 'Activer')?>
	<table class="quizz">
	<?php foreach ($questions as $question) { ?>
		<tr>
			<td><?php echo $question['intitulé']; ?></td>
			<td><i class="fa fa-search"></i></td>
			<td><i class="fa fa-times"></i></td>
		</tr>
	<?php } ?>
	</table>
	<?=anchor('quizz/create_question/'.$clef.'', 'Ajouter une question ➕')?>
	<?=anchor('quizz/participer/'.$clef.'', 'Participer')?>
	<?=anchor('quizz/correction/'.$clef.'', 'Voir la correction')?>
</body>