<div class="displayUnique">
	<h2>
		<?= $chapters->getTitle(); ?>
	</h2>
	<p>
		publié le: <?= $chapters->getAddDateView(); ?> 
	</p>
	<p>
		<?= nl2br($chapters->getContent()); ?>
	</p>
</div>

<div class="displayCom">
	<?php if(empty($comments)) :?>
	<p>
		Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !
	</p>
	<?php endif; ?>
 	<?php foreach ($comments as $comment) :?>
 	<div class="com">
 			<span class="bold">
 			<?= htmlspecialchars($comment->getAuthor()); ?> 
 			</span>
 			<?= nl2br(htmlspecialchars($comment->getContent())); ?>
 	</div>
 	<p class="notifDate">
 		<?= $comment->getDateView();?>
 	</p>
 	<?php endforeach; ?>
 	<a class="addCom" href="commenter-<?= $chapters->getId(); ?>.html">
		<i class="material-icons">comment</i>
		Ajouter un commentaire
	</a>
</div>

<div class="">
	<a href="/summary">
		<i class="material-icons">list</i>
		Retour au sommaire
	</a>
</div>




 