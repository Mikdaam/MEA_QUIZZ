<body>
	<p align="center"><?php echo validation_errors(); ?></p>
	<div id="container">
		<?php echo form_open('quizz/'); ?>
			<p><input type="text" name="title" placeholder="Titre du Quizz" required></p>
			<label><b>Durée</b></label>
			<p><input type="number" name="time" placeholder="" required></p>
			<p><input type="submit" name="creer" value="Créer"></p>
		</form>
	</div>
</body>
