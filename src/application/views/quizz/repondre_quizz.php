<div id="container">
	<div class="login">
		<h1>Question n° <?php echo $i; ?></h1>
		<p><?php echo $question['intitulé']; ?></p>
		<div class="ligne2"></div>
		<?php echo form_open('quizz/participer/'.$clef.'', 'onsubmit="return sendData();"'); ?>
		<table>
			<?php foreach ($options as $option) { ?>
			<tr>
				<td><input type="<?php echo $option['type']; ?>" name="true[]" id="true[]" value="<?php echo $option['intitulé']; ?>" ></td>
				<td><?php echo $option['intitulé']; ?></td>
			</tr>
			<?php } ?>
		</table>
		<div id="res"></div>
		<p><input type="submit" name="creer" value="Valider"></p>
	</form>
	</div>
</div>
