<?php
namespace Model;
 
use \BLOGFram\Manager;
use \Entity\Comment;
 
abstract class CommentsManager extends Manager
{
 	abstract public function count();
	
	abstract public function getList($debut = -1, $limite = -1);
	
  	abstract protected function add(Comment $comment);
 
  	public function save(Comment $comment)
  	{
    	if ($comment->isValid())
    	{
			$comment->isNew() ? $this->add($comment) : $this->modify($comment);
    	}
    	else
    	{
      	throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
		}
  	}
 
  	abstract public function getListOf($Chapters);
	
	abstract public function delete($id);
	
	abstract public function deleteFromChapters($chapters);
		
	abstract public function get($id);
	
}