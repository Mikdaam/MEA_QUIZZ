<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/create'); ?>

	<label for="title">Title</label>
	<input type="text" name="title"><br>

	<label for="texte">Texte</label>
	<textarea name="text"></textarea><br>

	<input type="submit" name="submit" value="Create un news item">

</form>
