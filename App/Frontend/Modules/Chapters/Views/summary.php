<div id="chapitres" class="container-fluid">
	<div class="row titleDisplay">
	  <hr class="decoTitle">
		<h2>
			Sommaire
		</h2>
	  <hr class="decoTitle">
	</div>

	<div  class="row">
		<table class="summary">
		<?php foreach ($listeChapters as $chapters) :?> 
			<tr>
				<td>
					<span class="bold">
					<a class="lienTitleChapter" href="chapters-<?=$chapters['id'];?>.html">
						<?= $chapters->getTitle(); ?> 
					</a>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	</div>
</div>	