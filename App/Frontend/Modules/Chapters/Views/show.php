<div class="displayUnique">
	<h2>
		<?= $chapters['title'] ?>
	</h2>
	<p>
		publié le: <?= $chapters->checkDate() ?> 
	</p>
	<p>
		<?= nl2br($chapters['content']) ?>
	</p>
</div>

<div class="displayCom">
	<?php if(empty($comments)) :?>
	<p>
		Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !
	</p>
	<?php endif; ?>
 	<div class="com">
 		<?php foreach ($comments as $comment) :?>
 			<span class="bold">
 			<?= htmlspecialchars($comment['author']); ?> 
 			</span>
 			<?= nl2br(htmlspecialchars($comment['content'])); ?>
 		<?php endforeach; ?>
 	</div>
 	<p class="notifDate">
 		<?= $comment->getDate();?>
 	</p>
 	<a class="addCom" href="commenter-<?= $chapters['id'] ?>.html">
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




 