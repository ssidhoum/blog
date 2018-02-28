<?php
namespace Entity;
use \BLOGFram\Entity;

class Comment extends Entity
{
  	protected 	$id,
				$chapters,
				$author,
            	$content,
            	$date;
  	const AUTEUR_INVALIDE = 1;
  	const CONTENU_INVALIDE = 2;
 
  	public function isValid()
  	{
	  return !(empty($this->author) || empty($this->content));
  	}
	
	//Setter
	public function setChapters($chapters)
  	{
		$this->chapters = (int) $chapters;
	}
 
  	public function setAuthor($author)
  	{
    	if (!is_string($author) || empty($author))
		{
			$this->erreurs[] = self::AUTEUR_INVALIDE;
    	}
    	$this->author = $author;
	}
 
  	public function setContent($content)
  	{
		if (!is_string($content) || empty($content))
    	{
			$this->erreurs[] = self::CONTENU_INVALIDE;
		}
			$this->content = $content;
  	}
 
  	public function setDate(\DateTime $date)
  	{
		$this->date = $date;
	}
	
	//Getter
	
	public function getId(){
		return $this->id;
	}
	
	public function getChapters()
  	{
		return $this->chapters;
  	}
 
  	public function getAuthor()
 	{
	  return $this->author;
  	}
 
  	public function getContent()
  	{
    	return $this->content;
  	}
 
  	public function getDate()
  	{
    return $this->date;
  	}
	
	//Fonction qui retourne la date au bon format
	public function getDateView(){
		$date = $this->date;
		return $date->format('d/m/Y');
	}

}