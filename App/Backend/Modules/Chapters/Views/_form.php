<form action="" method="post">
  <p>
    <?= isset($erreurs) && in_array(\Entity\Chapters::TITRE_INVALIDE, $erreurs) ? 'Le titre est invalide.<br />' : '' ?>
    <input class="inputTitle" type="text" name="titre" value="<?= isset($chapters) ? $chapters->getTitle() : '' ?>" placeholder="saissisez ici le titre de votre chapitre"/><br/>
 
    <?= isset($erreurs) && in_array(\Entity\Chapters::CONTENU_INVALIDE, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
    <textarea class="mytextarea" rows="8" cols="60" name="contenu"><?= isset($chapters) ? $chapters->getContent() : '' ?>
    </textarea><br/>
	<?php
	if(isset($chapters) && !$chapters->isNew())
	{
	?>
    	<input type="hidden" name="id" value="<?= $chapters->getId(); ?>" />
    	<input type="submit" value="Modifier" name="modifier" />
	<?php
	}
	  else
	  {
	  ?>
    	<input type="submit" value="Ajouter" />
	<?php
	  }
	  ?>
 		<input type="checkbox" name="case" id="case"/> <label for="case">Mettre en ligne</label>

  </p>
</form>


