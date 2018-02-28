<?php
namespace Entity;

use \BLOGFram\Entity;

class Chapters extends Entity
{
	
	protected 	$publi,
	  			$title,
            	$content,
            	$addDate,
            	$updateDate;

  	const TITRE_INVALIDE = 2;
  	const CONTENU_INVALIDE = 3;

	public function isValid()
  	{
    	return !(empty($this->title) || empty($this->content));
  	}
	
	//Setters
	
	public function setPubli( $publi)
  	{
    	$this->publi = $publi;
  	}

  	public function setTitle($title)
  	{
		if (!is_string($title) || empty($title))
    	{
      		$this->erreurs[] = self::TITRE_INVALIDE;
    	}
    	$this->title = $title;
  	}

	public function setContent($content)
  	{
    	if (!is_string($content) || empty($content))
    	{
      		$this->erreurs[] = self::CONTENU_INVALIDE;
    	}
		$this->content = $content;
  	}

  	public function setAddDate(\DateTime $addDate)
  	{
    	$this->addDate = $addDate;
  	}

	public function setUpdateDate(\DateTime $updateDate)
  	{
    	$this->updateDate = $updateDate;
  	}
	
	//Getters
	
	public function getPubli()
  	{
		return $this->publi;
  	}

  	public function getTitle()
  	{
		return $this->title;
  	}

	public function getContent()
  	{
    	return $this->content;
  	}

  	public function getAddDate()
  	{
    	return $this->addDate;
  	}

  	public function getUpdateDate()
  	{
		return $this->updateDate;
  	}
	
	//fonction qui retourne la date d'ajout au bon format 
	public function getAddDateView(){
		$date = $this->addDate;
		return $date->format('d/m/Y');
	}
	
	//fonction qui retourne la date de modif au bon format
	public function getUpdateDateView(){
		$date = $this->update;
		return $date->format('d/m/Y');
	}
	
}