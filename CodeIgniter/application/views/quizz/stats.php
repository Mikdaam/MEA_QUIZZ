<body>
	<h1><?php echo $title; ?></h1>
	<p>Nombre de question : <?php echo $nb; ?></p>
	Liste des participants:
	<table>
		<thead>
			<td>Nom</td>
			<td>Prénom</td>
			<td>Note</td>
		</thead>
	<?php foreach ($students as $student) { ?>
		<tr>
			<td><?php echo $student['']; ?></td>
			<td><?php echo $student['']; ?></td>
			<td><?php echo $student['']; ?></td>
		</tr>
	<?php } ?>
	</table>
</body>