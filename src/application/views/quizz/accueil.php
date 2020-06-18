<body>
  <!-- Navbar -->
  <div class="topnav">
    <div class="topnav-centered">
      <?=anchor('quizz/acces_correction', 'VOIR LA CORRECTION D\'UN QUIZZ')?>
    </div>
    <a href="#news" class="active">ACCUEIL<hr color="white"/></a>
    <div class="topnav-right">
      <?=anchor('quizz/verifier_quizz', 'REJOINDRE UN QUIZZ')?>
    </div>
  </div>
  <!-- Titre -->
  <div class="tete">
    <div class="titre">
      <h2>BIENVENUE SUR LE</h2>
      <h1>MEA QUIZZ</h1>
      <div class="ligne1"></div>
      <div class="ligne2"></div>
      <img src="<?php echo base_url("img/logo.png"); ?>" />
    </div>
    <div class="description">
      <div class="texte1">
        Ici, si vous êtes Professeur, préparez vos meilleurs QCM pour vos
        fabuleux élèves !
      </div>
      <br />
      <div class="texte2">
        Si vous êtes élève tenez-vous prêt à répondre aux questionnaires de
        vos professeurs !
      </div>
    </div>
    <?=anchor('connect/', 'Connexion', array('id'=>'bouton', 'class'=>'connexion'))?>
    <?=anchor('connect/create_user', 'Inscription', array('id'=>'bouton', 'class'=>'inscription'))?>
  </div>
  <div class="footer">
    <p class="credit">
      Vous êtes sur un site programmé par Mikdaam Badarou, Alexis Chochina et
      Emmanuel Deniaux.
    </p>
    <p class="copyright">@Copyright 2020 MEA Quizz</p>
  </div>
</body>