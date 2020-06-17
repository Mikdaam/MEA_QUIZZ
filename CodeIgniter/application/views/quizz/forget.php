<body>
	<p align="center"><?php echo validation_errors(); ?></p>
	<div id="container"> 
		<?php echo form_open('connect/forget'); ?>
			<p><input type="email" name="mail" placeholder="Adresse Email" required></p>
			<p><input type="password" name="password" placeholder="Nouveau mot de passe" required></p>
			<p><input type="password" name="passconf" placeholder="Confirmer le mot de passe" required></p>
			<input type="submit" id='submit' value="Changer">
			<div align="center">
				<p><?php echo $msg; ?></p>
				<?=anchor('connect/', 'Retour à la connexion')?>
			</div>
		</form>
	</div>
</body>
