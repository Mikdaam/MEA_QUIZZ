<body>
    <div id="container">
        <form class="score">
            <h2>Score</h2>
            <div class="ligne3"></div>
            <a class="pourcentage">Pourcentage de bonne notes : </a><a class="monscore"><?php $score ?></a>
        </form>
        <form>
            <h1>Question <?php echo $i; ?></h1>
            <div class="ligne"></div>
            <p class="question"><?php echo $question['intitulé']; ?></p>
            <div class="ligne2"></div>
            <?php foreach ($options as $option) {?>
            <div class="reponsebon"><?php echo $option['intitulé']; ?></div>
        	<?php } ?>
        </form>
    </div>
</body>