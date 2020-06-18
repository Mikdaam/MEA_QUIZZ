<body>
	<?php echo validation_errors(); ?>
    <div id="container">
       <?php echo form_open('connect/create_user'); ?>
            <h1>Inscription</h1>
            <div class="ligne"></div>               
            <label><b>Nom </b></label>
            <input type="text" value="<?=set_value('nom')?>" placeholder="Entrez votre nom " name="nom" required>
            <label><b>Prenom </b></label>
            <input type="text" value="<?=set_value('prenom')?>" placeholder="Entrez votre prénom" name="prenom" required>
            <label><b>Adresse email </b></label>
            <input type="email" value="<?=set_value('mail')?>" placeholder="Entrez votre adresse mail" name="mail" required>
            <label><b>Choisir un mot de passe</b></label>
            <input type="password" value="<?=set_value('password')?>" placeholder="Entrez le mot de passe" name="password" required>
            <input type="submit" id='submit' value="S'inscrire">
            <div align="center">
				<p>Dèjà un compte? <span class="ins"><?=anchor('connect/', 'Connectez-vous')?></span></p>
			</div>
        </form>
    </div>
</body>