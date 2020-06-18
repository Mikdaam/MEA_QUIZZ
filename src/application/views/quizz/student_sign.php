<body>
    <div id="container">
        <?php echo validation_errors(); ?>
        <?php echo form_open('quizz/verifier_quizz'); ?>
            <h1>Je suis étudiant</h1>
            <div class="ligne"></div>
            
            <label><b>Nom</b></label>
            <input type="text" value="<?=set_value('nom')?>" placeholder="Entrez votre nom" name="nom" required>

            <label><b>Prénom</b></label>
            <input type="text" value="<?=set_value('prenom')?>" placeholder="Entrez votre prénom" name="prenom" required>

            <label><b>Clé</b></label>
            <input type="text" value="<?=set_value('clef')?>" placeholder="Entrez la clé du quizz" name="clef" required>
            <p align="center"><?php echo $msg; ?></p>
            <input type="submit" id='submit' value='Connexion' >
        </form>
    </div>
</body>