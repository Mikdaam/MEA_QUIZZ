<body>
    <?=anchor('quizz/quizz_list/', '<i class="fas fa-arrow-left"></i>', array('class'=>'retour'))?>
    <h1><?php echo $title; ?></h1>
    <div class="ligne"></div>
    <h2 align="center" style="color: white;"><?php echo $msg; ?></h2>
    <div class="tableau">
      <table>
        <tr>
          <th>NOM</th>
          <th>PRENOM</th>
          <th>NOTE</th>
          <th>POURCENTAGE</th>
        </tr>
        <?php foreach ($stats as $stat) {
        	$pourcent = ($stat['note']*100)/20;
        ?>
        <tr>
          <td><?php echo $stat['nom']; ?></td>
          <td><?php echo $stat['prenom']; ?></td>
          <td><?php echo $stat['note']; ?></td>
          <td><?php echo $pourcent.' %'; ?></td>
        </tr>
    	<?php } ?>
      </table>
    </div>
</body>