<body>
  <?=anchor('connect/deconnexion', 'Déconnexion', array('class'=>'deconnexion'))?>
  <h1>Bienvenue <?php echo $user['nom'].' '.$user['prenom']; ?></h1>
  <div class="ligne1"></div>
  <?=anchor('quizz/', '+ Nouveau quizz', array('class'=>'new'))?>
  <h2>
    Quiz déjà créés
  </h2>
  <h2><?php echo $msg; ?></h2>
  <div class="ligne2"></div>
  <div class="tableau">
    <table>
      <tr class="en-tete">
        <th>TITRE</th>
        <th>STATUT</th>
        <th>DATE DE CREATION</th>
        <th>STATISTIQUES</th>
        <th>COPIER LA CLE</th>
        <th>MODIFIER</th>
        <th>SUPPRIMER</th>
      </tr>
      <?php foreach ($quizzs as $quizz) { 
        $date = strtotime($quizz['date_creation']);
      ?>
      <tr>
        <td><?php echo $quizz['Titre']; ?></td>
        <td><?php echo $quizz['Statut']; ?></td>
        <td><?php echo date("d-m-Y", $date) ?></td>
        <td><?=anchor('quizz/statistique/'.$quizz['Clef'].'', 'Voir statistiques', array('class'=>'icone'))?></td>
        <td class="icone"><i class="fa fa-copy"> Copiez la clé!</i></td>
        <?php if ($quizz['Statut'] == 'Actif') {?>
         <td><i class="fas fa-edit"></i> Quizz non modifiable.</td>
        <?php }else{ ?>
          <td><?=anchor('quizz/afficher/'.$quizz['Clef'].'', '<i class="fa fa-edit"></i>', array('class'=>'icone'))?>
        <?php } ?>
        <td>
          <?=anchor('quizz/supprimer_quizz/'.$quizz['Clef'].'', '<i class="fa fa-close"></i>', array('class'=>'icone'))?>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
</body>