<body>
	<p align="center"><?php echo validation_errors(); ?></p>
    <div id="container"> 
        <?php echo form_open('connect/index'); ?>
            <h1>Connexion</h1>
            <div class="ligne"></div>
            
            <label><b>Adresse mail</b></label>
            <input type="text" placeholder="Entrer l'adresse mail" name="mail" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required>
            <div align="center">
				<p><?php echo $msg; ?></p>
			</div>
            <input type="submit" id='submit' value="Se connecter">

            <span class="eleve"><?=anchor('connect/forget', 'Mot de passe oublié?')?></span>
            <span class="ins"><?=anchor('connect/create_user', 'Inscrivez-vous')?></span>
        </form>
    </div>
</body>
<?php 
date_default_timezone_set('Europe/Paris');
echo date('l Y-m-d H:i:s');
?>
