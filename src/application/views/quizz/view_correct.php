<form>
    <h1>Question <?php echo $i; ?></h1>
    <div class="ligne"></div>
    <p class="question"><?php echo $question['intitulé']; ?></p>
    <div class="ligne2"></div>
    <?php
        $nb_rep = count($reponses);
        for ($i=0; $i < $nb; $i++) { 
            for ($j=0; $j < $nb_rep; $j++) { 
                if (in_array($options[$i]['intitulé'], $reponses[$j])) {
                    $classe = 'reponsebon';
                }else
                    $classe = 'reponsemauvais';               
            }
    ?>
    <div class="<?php echo $classe; ?>"><?php echo $options[$i]['intitulé']; ?></div>
	<?php } ?>
</form>
