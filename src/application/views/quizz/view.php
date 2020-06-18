<body>
    <?=anchor('quizz/quizz_list/', '<i class="fas fa-arrow-left"></i>', array('class'=>'retour'))?>
    <h1><?php echo $title; ?></h1>
    <div class="ligne"></div>
    <?php $etat = 'Actif' ?>
    <?=anchor('quizz/change_quizz_state/'.$clef.'/'.$etat.'', 'Activer le quizz', array('class'=>'bouton'))?>
    <div class="tableau">
    	<?php 
			if ($nb_question < 2) {
				echo '<h2>Ce quizz comporte actuellement '.$nb_question.' question.</h2>';
			}else
				echo '<h2>Ce quizz comporte actuellement '.$nb_question.' questions.</h2>';
		?>
      <table>
        <tr class="en-tete">
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($questions as $question) { ?>
        <tr>
          <td><?php echo $question['intitulé']; ?></td>
          <td>
            <a class="icone" href="#modifier"><i class="fas fa-edit"></i></a>
          </td>
          <td>
            <?=anchor('quizz/supprimer_question/'.$question['numero'].'', '<i class="fa fa-close"></i>', array('class'=>'icone'))?>
          </td>
        </tr>
        <?php } ?>
      </table>
      <?=anchor('quizz/create_question/'.$clef.'', 'Ajouter une question', array('class'=>'ajouter'))?>
    </div>
</body>
