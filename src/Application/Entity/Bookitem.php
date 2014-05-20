<?php 
namespace Application\Entity;



class Bookitem
{
public $name;
public $author;
public $publisher;
public $id;
public $year;
public $price;
public $id_catalog;
public $description;	
public $img_ref;
public $condition;
	 public function exchangeArray($data)
 {
 $this->name = (!empty($data['name'])) ? $data['name'] : null;
 $this->author = (!empty($data['author'])) ? $data['author'] : null;
 $this->id_catalog = (!empty($data['id_catalog'])) ? $data['id_catalog'] : null;
  $this->publisher = (!empty($data['publisher'])) ? $data['publisher'] : null;
  $this->year = (!empty($data['year'])) ? $data['year'] : null;
  $this->description = (!empty($data['description'])) ? $data['description'] : null;
  $this->img_ref = (!empty($data['img_ref'])) ? $data['img_ref'] : null;
  $this->id = (!empty($data['id_position'])) ? $data['id_position'] : null;
  $this->condition = (!empty($data['condition'])) ? $data['condition'] : null;
 
 
 
 
 
 
 
 }
 
  public function getArrayCopy()
 {
 return get_object_vars($this);
 }
	
}













?>