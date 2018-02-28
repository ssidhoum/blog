<div class="container-fluid">
	<div class="col-4 preview">
		<div class="serviceTitle">
			Coup d'oeil
		</div>
		<div>
			<p>
				<span>
					<i class="material-icons">book</i>
				</span>
				<?= $nombreChapters;?>
				Chapitres	
			</p>
			<p>
				<span>
					<i class="material-icons">comment</i>
				</span>
				<?= $nombreComments;?>
				Commentaires
			</p>
		</div>
	</div>
	
	<div class="row displayChapters">
		<div class="col-10 displayIndexChapters">
			<h2>
				Les chapitres:
			</h2>
			<table class="table">
  				<tr>
  					<th>
  						Titre
  					</th>
  					<th>
  						Ajout
  					</th>
  					<th>
  						Modif
  					</th>
  					<th>
  						Action
  					</th>
  					<th>
  						Statut
  					</th>
  				</tr>
				<?php foreach ($listeChapters as $chapters):?>
    			<tr>
        			<td>
        				<?= $chapters->getTitle(); ?>
        			</td>
        			<td>
        				le <?= $chapters->getAddDateView(); ?>
       				 </td>
        			<td>
        				 <?= $chapters->getAddDateView();?></td>
        			<td>
            			<a href="/admin/chapters-update-<?=$chapters->getId();?>.html">
               				 <i class="material-icons">create</i>
           				</a>
           				<a class="deleteChap" id="<?=$chapters->getId();?>">
                			<i class="material-icons">delete_sweep</i>
            			</a>
        			</td>
        			<td>
        				<?= $chapters->isOnline();?>
        			</td>
    			</tr>
				<?php endforeach; ?>
			</table>	
		</div>
	
		<div class="col-2 displayAddChapters">
			<a href="/admin/chapters-insert.html">
				<span>
				<i class="material-icons">add_circle</i>
				</span> <br>
				Ajouter un chapitre
			</a>
		</div>
	</div>

	<div class="row displayComments">
		<div class="col-10 displayIndexComments">
			<h2>
				Les commentaires:
			</h2>
			<table class="table">
				<tr>
					<th>
						Auteur
					</th>
					<th>
						Date
					</th>
					<th>
						Action
					</th>
				</tr>
				<?php foreach ($listeComments as $comments) :?>
				<tr>
					<td>
						<?=$comments->getAuthor();;?>
					</td>
					<td>
						le <?=$comments->getDateView();?>
					</td>
					<td>
						<a class="deleteCom" data-toggle="modal"  id="<?= $comments->getId();?>">
							<i class="deleteComIcon material-icons">delete_sweep</i>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
													
			</table>
		</div>
	</div>
	
	<div class="modal modalLogOut" tabindex="-1" role="dialog">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title">Attention</h5>
        			<button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
       		 		</button>
      			</div>
      			<div class="modal-body">
        			<p>
        				Vous allez vous déconnecter. Voulez-vous continuer?
        			</p>
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-primary confirmLogOut">Oui</button>
        			<button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Fermer</button>
      			</div>
    		</div>
  		</div>
	</div>
	
	<div class="modal modalDeleteChap" tabindex="-1" role="dialog">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title">Attention</h5>
        			<button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
       		 		</button>
      			</div>
      			<div class="modal-body">
        			<p>
        				Vous allez vous déconnecter. Voulez-vous continuer?
        			</p>
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-primary confirmDeleteChap">Oui</button>
        			<button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Fermer</button>
      			</div>
    		</div>
  		</div>
	</div>
	
	<div class="modal modalDeleteCom" tabindex="-1" role="dialog">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title">Attention</h5>
        			<button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
       		 		</button>
      			</div>
      			<div class="modal-body">
        			<p>
        				Vous allez supprimer ce commentaire. Voulez-vous continuer?
        			</p>
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-primary confirmDeleteCom">Oui</button>
        			<button type="button" class="btn btn-secondary closeModal" data-dismiss="modal">Fermer</button>
      			</div>
    		</div>
  		</div>
	</div>
	
</div>