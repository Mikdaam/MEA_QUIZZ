<body>
	<p align="center"><?php echo validation_errors(); ?></p>
	<div id="container">
	<div class="login">
	  	<h1>Question</h1>
        <div class="ligne"></div>
		<?php echo form_open('quizz/create_question/'.$clef.'', 'class="login-container", id="form"'); ?>
			<textarea name="text" rows="2" cols="36" placeholder="Intitulé de la question" required></textarea>
			<div>
				<div id="line"><span>Propositions</span></div>
				<div id="line2">
					<label>Type : </label>
					<select name="type">
						<option>Sélectionner</option>
						<option value="radio">Bouton radio</option>
						<option value="checkbox">Case à cocher</option>
					</select>
				</div>
			</div>
			<div class="ligne2"></div>
			<div class="container">
				<div class="type">
					Veuillez choisir un type ! &#x2714;
				</div>
			</div>
			<div class="cocher">
				<p>✔ Cochez la/les bonnes réponses</p>
			</div>
			<p><input type="submit" name="create" value="Enregister"></p>
		</div>
	</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	 $(document).ready(function(){
        $("select").change(function(){
        	var type = $(this).children("option:selected").val();
            var checkbox = "<table class='test'><tr><td><input type='checkbox' name='true[]' value='zero'></td><td><input type='text' name='option[]' placeholder='Option' required></td></tr><tr><td><input type='checkbox' name='true[]' value='un'></td><td><input type='text' name='option[]' placeholder='Option' required></td></tr><tr><td><input type='checkbox' name='true[]'' value='deux'></td><td><input type='text' name='option[]' placeholder='Option' required></td></tr></table><div align='center'><button type='button' class='add'><i class='fa fa-plus'></i></button>";
            var radio = "<table><tr><td><input type='radio' name='true[]' value='zero' required></td><td><input type='text' name='option[]' placeholder='Option' required></td></tr><tr><td><input type='radio' name='true[]' value='un' required></td><td><input type='text' name='option[]' placeholder='Option' required></td></tr></table>";
            if(type == "radio"){
                $(".type").replaceWith("<div class='type'>"+radio+"</div>");
            }
            else if(type == "checkbox")
            {
                $(".type").replaceWith("<div class='type'>"+checkbox+"</div>");
                var nom = ['trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf'];
                var i = 0;
                $(".add").click(function() {
			        var ligne = 
			        "<tr><td><input type='checkbox' name='true[]' value='"+nom[i]+"'></td><td><input type='text' name='option[]' placeholder='Option' required></td><td><a href=\"javascript:void(0);\" class=\"delete\">×</a></td></tr>";
			        if  ($("table.test input[type=text]").length <10) 
			        	$("table.test").append(ligne);
			        else
			        	alert("Vous pouvez pas avoir plus de 10 propositions de réponses.\nMerci pour votre compréhension!");
			        i++;
			    });
			    $(document).on("click", "a.delete", function() {
			        $(this).parents("table.test tr").remove();
			    });
			    $('#form').on('submit', function() {
				    var i = 0;
				     
				    $(':checked').each(function(){
				        i++;
				    });
				    if(i == 0){
				        $('#err').empty();
				        $('#err').append("Veuillez cohez au moins une case.");
				        $('#err').css('color','red');
				        return false;
				    }
				});
            }
        });
    });
</script>
