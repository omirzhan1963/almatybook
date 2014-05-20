<?php
namespace Application\Entity;

use Application\Entity\Catalogitem; 
class Sectionitem
{
	public $id_section;
	public $name_section;
	public $pos_section;
	public $catalogrow;
	public function _get($property)
	{return $this->$property;
	}
	public function additem(Catalogitem $item){
		if (!is_array($this->catalogrow)) $this->catalogrow=array();
		if ($item->id_section==$this->id_section)
		$this->catalogrow[]=$item;
		return $this;
		
		
	}
	 public function exchangeArray($data)
 {
 $this->id_section = (!empty($data['id_section'])) ? $data['id_section'] : null;
 $this->name_section = (!empty($data['section_name'])) ? $data['section_name'] : null;
 $this->pos_section = (!empty($data['section_pos'])) ? $data['section_pos'] : null;
 $this->catalogrow = (!empty($data['catalogrow'])) ? $data['catalogrow'] : null;
 }
 
  public function getArrayCopy()
 {
 return get_object_vars($this);
 }
	}