<body>
	<p align="center"><?php echo validation_errors(); ?></p>
	<div id="container">
		<div class="login">
			<h1>Question n° <?php echo $i; ?></h1>
			<p><?php echo $question['intitulé']; ?></p>
			<div class="ligne2"></div>
			<?php echo form_open('quizz/participer/'.$clef.'', 'class="login-container"'); ?>
			<table>
				<?php foreach ($options as $option) { ?>
				<tr>
					<td><input type="<?php echo $option['type']; ?>" name="true[]" value="<?php echo $option['intitulé']; ?>" ></td>
					<td><?php echo $option['intitulé']; ?></td>
				</tr>
				<?php } ?>
			</table>
			<p><input type="submit" name="creer" value="Valider"></p>
		</form>
		</div>
	</div>
</body>