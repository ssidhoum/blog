<?php
namespace App\Frontend\Modules\Chapters;
 
use \BLOGFram\BackController;
use \BLOGFram\HTTPRequest;
use \Entity\Comment;
 
class ChaptersController extends BackController
{
  	public function executeIndex(HTTPRequest $request)
  	{
    	$nombreChapters = $this->app->config()->get('nombre_chapters');
    	$nombreCaracteres = $this->app->config()->get('nombre_caracteres');
 
    // On ajoute une définition pour le titre.
    	$this->page->addVar('title', 'Liste des '.$nombreChapters.' dernières news');
 
    // On récupère le manager des news.
    	$manager = $this->managers->getManagerOf('Chapters');
 
    	$listeChapters = $manager->getListOnline(0, $nombreChapters);
 
    	foreach ($listeChapters as $chapters)
    	{
      	if (strlen($chapters->getContent()) > $nombreCaracteres)
      	{
        	$debut = substr($chapters->getContent(), 0, $nombreCaracteres);
        	$debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
        	$chapters->setContent($debut);
      	}
    	}
 
    // On ajoute la variable $listeNews à la vue.
    $this->page->addVar('listeChapters', $listeChapters);
  }
 
  	public function executeShow(HTTPRequest $request)
  	{
    	$chapters = $this->managers->getManagerOf('Chapters')->getUnique($request->getData('id'));
 
    	if (empty($chapters))
    	{
      	$this->app->httpResponse()->redirect404();
    	}
 
		$this->page->addVar('title', $chapters->getTitle());
	    $this->page->addVar('chapters', $chapters);
    	$this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($chapters->id()));
  	}
 
  	public function executeInsertComment(HTTPRequest $request)
  	{
    $this->page->addVar('title', 'Ajout d\'un commentaire');
 
    if ($request->postExists('pseudo'))
    {
      $comment = new Comment([
        'chapters' => $request->getData('chapters'),
        'author' => $request->postData('pseudo'),
        'content' => $request->postData('contenu')
      ]);
 
      if ($comment->isValid())
      {
        $this->managers->getManagerOf('Comments')->save($comment);
 
        $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
 
        $this->app->httpResponse()->redirect('chapters-'.$request->getData('chapters').'.html');
      }
      else
      {
        $this->page->addVar('erreurs', $comment->erreurs());
      }
 
      $this->page->addVar('comment', $comment);
    }
}
	
	public function executeSummary(HTTPRequest $request){
		$this->page->addVar('title', 'Sommaire');

   		$manager = $this->managers->getManagerOf('Chapters');
		
    	$this->page->addVar('listeChapters', $manager->getListOnline());
	
	}
	
	public function executeMentions(HTTPRequest $request)
  	{
    	$this->page->addVar('title', 'Mentions légales');
	}
	
}