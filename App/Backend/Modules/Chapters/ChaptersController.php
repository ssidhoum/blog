<?php
namespace App\Backend\Modules\Chapters;

use \BLOGFram\BackController;
use \BLOGFram\HTTPRequest;
use \Entity\Chapters;
use \Entity\Comment;

class ChaptersController extends BackController
{
	public function executeIndex(HTTPRequest $request)
  	{
    	$this->page->addVar('title', 'Gestion des chapitres');
   		$manager = $this->managers->getManagerOf('Chapters');
		$manager2 = $this->managers->getManagerOf('Comments');
    	$this->page->addVar('listeChapters', $manager->getList());
    	$this->page->addVar('nombreChapters', $manager->count());
		$this->page->addVar('nombreComments', $manager2->count());
		$this->page->addVar('listeComments', $manager2->getList());
	  
  	}
	
	public function executeUpdate(HTTPRequest $request)
	{
    	if ($request->postExists('titre'))
    	{
			$this->processForm($request);
    	}
    	else
    	{
      		$this->page->addVar('chapters', $this->managers->getManagerOf('Chapters')->getUnique($request->getData('id')));
    	}
 
		$this->page->addVar('title', 'Modification d\'un chapitre');
  	}
	
	public function executeDelete(HTTPRequest $request)
  	{
    	$this->managers->getManagerOf('Chapters')->delete($request->getData('id'));
    
    	$this->app->user()->setFlash('Le chapitre a bien été supprimé !');
    
    	$this->app->httpResponse()->redirect('.');
  	}

	public function executeInsert(HTTPRequest $request)
  	{
    	if ($request->postExists('titre'))
    	{
			$this->processForm($request);
    	}
 
    	$this->page->addVar('title', 'Ajout d\'un chapitre');

  	}
	
	public function processForm(HTTPRequest $request)
  	{	
    	$chapters = new Chapters([
      		'title' => $request->postData('titre'),
      		'content' => $request->postData('contenu'),
    	]);
		
		$request->postExists('case') ? $chapters->setPubli(1) : $chapters->setPubli(0);
		
    	if ($request->postExists('id'))
    	{
      		$chapters->setId($request->postData('id'));
	
    	}
 
    	if ($chapters->isValid())
    	{

      		$this->managers->getManagerOf('Chapters')->save($chapters);
			
      		$this->app->user()->setFlash($chapters->isNew() ? 'Le chapitre a bien été ajouté !' : 'Le chapitre a bien été modifié !');
    	}
    	else
    	{
      		$this->page->addVar('erreurs', $chapters->erreurs());
    	}
		
    	$this->page->addVar('news', $chapters);
		var_dump($chapters->getPubli());
		
  	}
	
	public function executeDeleteComment(HTTPRequest $request)
  	{
    	$this->managers->getManagerOf('Comments')->delete($request->getData('id'));
    	$this->app->user()->setFlash('Le commentaire a bien été supprimé !');
    	$this->app->httpResponse()->redirect('.');
  	}
	
	public function executeLogOut(HTTPRequest $request){
		$this->app->user()->logOut();
	}
		
}
	
	
	
	