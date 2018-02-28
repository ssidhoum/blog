<?php
namespace Model;
 
use \Entity\Chapters;
 
class ChaptersManagerPDO extends ChaptersManager
{
	public function count()
	{
    	return $this->dao->query('SELECT COUNT(*) FROM chapters')->fetchColumn();
	}
	
  	public function getList($debut = -1, $limite = -1)
	{
		//$nbArt=($this -> count());
		//$perPage = 4;
		//$nbPage = ceil($nbArt/$perPage);
		//$cPage= 1;
    	$sql = 'SELECT id, title, content, addDate, updateDate, publi FROM chapters ORDER BY id DESC';
 
    	if ($debut != -1 || $limite != -1)
    	{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
 
    	$requete = $this->dao->query($sql);
    	$requete->setFetchMode(\PDO::FETCH_CLASS,  '\Entity\Chapters');
 
    	$listeChapters = $requete->fetchAll();
 
    	foreach ($listeChapters as $chapters)
    	{
      		$chapters->setAddDate(new \DateTime($chapters->addDate()));
      		$chapters->setUpdateDate(new \DateTime($chapters->updateDate()));
    	}
 		
		/**for($i=1; $i<=$nbPage; $i++){
			echo "$i/";
		}**/
			
    	$requete->closeCursor();
 
    	return $listeChapters;
	}
	
	public function getListOnline($debut = -1, $limite = -1)
	{
    	$sql = 'SELECT id, title, content, addDate, updateDate, publi FROM chapters  WHERE publi = 1 ORDER BY id DESC';
 
    	if ($debut != -1 || $limite != -1)
    	{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}
 
    	$requete = $this->dao->query($sql);
    	$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapters');
 
    	$listeChapters = $requete->fetchAll();
 
    	foreach ($listeChapters as $chapters)
    	{
      		$chapters->setAddDate(new \DateTime($chapters->addDate()));
      		$chapters->setUpdateDate(new \DateTime($chapters->updateDate()));
    	}
 
    	$requete->closeCursor();
 
    	return $listeChapters;
	}
 
  	public function getUnique($id)
  	{
    	$requete = $this->dao->prepare('SELECT id, title, content, addDate, updateDate, publi FROM chapters WHERE id = :id');
    	$requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    	$requete->execute();
 
    	$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapters');
 
    	if ($chapters = $requete->fetch())
    	{
			$chapters->setAddDate(new \DateTime($chapters->addDate()));
     		$chapters->setUpdateDate(new \DateTime($chapters->updateDate()));
 
			return $chapters;
    	}
 
    	return null;
  	}
	
	public function delete($id)
	{
    	$this->dao->exec('DELETE FROM chapters WHERE id = '.(int) $id);
  	}

	protected function modify(Chapters $chapters)
  	{
    	$requete = $this->dao->prepare('UPDATE chapters SET title = :titre, content = :content, updateDate = NOW() WHERE id = :id');
 
    	$requete->bindValue(':titre', $chapters->title());
    	$requete->bindValue(':content', $chapters->content());
    	$requete->bindValue(':id', $chapters->id(), \PDO::PARAM_INT);
 
    	$requete->execute();
		}
	
	protected function add(Chapters $chapters)
  	{
		
    		$requete = $this->dao->prepare('INSERT INTO chapters SET title = :titre, content = :contenu, addDate = NOW(), updateDate = NOW()');
    		$requete->bindValue(':titre', $chapters->title());
			$requete->bindValue(':contenu', $chapters->content());
			
			$requete->execute();
			
		}
	
	
	

	
	
	
}