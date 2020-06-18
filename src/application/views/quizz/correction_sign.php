<body>
    <div id="container">
        <?php echo validation_errors(); ?>
        <?php echo form_open('quizz/acces_correction'); ?>
            <h1>Voir la correction d'un quizz</h1>
            <div class="ligne"></div>

            <label><b>Clé</b></label>
            <input type="text" value="<?=set_value('clef')?>" placeholder="Entrez votre clé personnelle" name="clef" required>
            <p align="center"><?php echo $msg; ?></p>
            <input type="submit" id='submit' value='Connexion' >
        </form>
    </div>
</body>