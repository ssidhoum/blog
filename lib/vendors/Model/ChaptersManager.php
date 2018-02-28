<?php
namespace Model;
 
use \BLOGFram\Manager;
use \Entity\Chapters;
 
abstract class ChaptersManager extends Manager
{
 
	abstract public function count();
	
  	abstract public function getList($debut = -1, $limite = -1);
 
  	abstract public function getUnique($id);
	
	public function save(Chapters $chapters)
  	{
    if ($chapters->isValid())
    {
      	$chapters->isNew() ? $this->add($chapters) : $this->modify($chapters);
		
    }
    else
    {
      throw new \RuntimeException('La news doit être validée pour être enregistrée');
    }
	
  }
	
	abstract public function delete($id);
	
	abstract protected function modify(Chapters $chapters);
	
	abstract protected function add(Chapters $chapters);
	
}