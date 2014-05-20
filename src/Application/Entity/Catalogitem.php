<?php
namespace Application\Entity;


class Catalogitem
{
	public $id_catalog;
	public $name_catalog;
	public $id_section;
	 public function exchangeArray($data)
 {
 $this->id_section = (!empty($data['id_section'])) ? $data['id_section'] : null;
 $this->name_catalog = (!empty($data['name'])) ? $data['name'] : null;
 $this->id_catalog = (!empty($data['id_catalog'])) ? $data['id_catalog'] : null;
 }
 
  public function getArrayCopy()
 {
 return get_object_vars($this);
 }
	
	}