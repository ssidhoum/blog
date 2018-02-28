<?php
namespace Model;
 
use \Entity\Comment;
 
class CommentsManagerPDO extends CommentsManager
{
	
	public function count()
	{
    	return $this->dao->query('SELECT COUNT(*) FROM comments')->fetchColumn();
  	}
	
	public function getList($debut = -1, $limite = -1)
	{
    	$sql = 'SELECT id, author, content, date FROM comments ORDER BY id DESC';
 
    	if ($debut != -1 || $limite != -1)
    	{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
 
    	$requete = $this->dao->query($sql);
    	$requete->setFetchMode(\PDO::FETCH_CLASS, '\Entity\Comment');
 
    	$listeComments  = $requete->fetchAll();
 
    	foreach ($listeComments as $comments)
    	{
      		$comments->setDate(new \DateTime($comments->Date()));
    	}
 
    	$requete->closeCursor();
 
    	return $listeComments;
	}
	
  	protected function add(Comment $comment)
  	{
    	$q = $this->dao->prepare('INSERT INTO comments SET chapters = :chapters, author = :author, content = :content, date = NOW()');
 
    	$q->bindValue(':chapters', $comment->chapters(), \PDO::PARAM_INT);
    	$q->bindValue(':author', $comment->author());
    	$q->bindValue(':content', $comment->content());
 
    	$q->execute();
 
    	$comment->setId($this->dao->lastInsertId());
  }
 
  	public function getListOf($chapters)
  	{
    	if (!ctype_digit($chapters))
    	{
      		throw new \InvalidArgumentException('L\'identifiant de la chapters passé doit être un nombre entier valide');
    	}
 
    	$q = $this->dao->prepare('SELECT id, chapters, author, content, date FROM comments WHERE chapters = :chapters');
    	$q->bindValue(':chapters', $chapters, \PDO::PARAM_INT);
    	$q->execute();
 
    	$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    	$comments = $q->fetchAll();
 
    	foreach ($comments as $comment)
    	{
      		$comment->setDate(new \DateTime($comment->date()));
    	}
 
    	return $comments;
  	}
	
	public function delete($id)
	{
    	$this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  	}
	
	public function deleteFromChapters($chapter)
	{
    	$this->dao->exec('DELETE FROM comments WHERE chapters = '.(int) $chapters);
  	}
	
	protected function modify(Comment $comment)
  	{
    	$q = $this->dao->prepare('UPDATE comments SET author = :author, content = :content WHERE id = :id');
 
    	$q->bindValue(':author', $comment->author());
    	$q->bindValue(':content', $comment->content());
    	$q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
 
    	$q->execute();
  	}
	
	public function get($id)
  	{
    	$q = $this->dao->prepare('SELECT id, chapters, author, content FROM comments WHERE id = :id');
    	$q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    	$q->execute();
 
    	$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
 
    	return $q->fetch();
  	}
	
}