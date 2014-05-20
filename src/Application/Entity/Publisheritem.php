<?php 
namespace Application\Entity;



class Publisheritem
{
public $name;
public $city;
public $country;
public $id;
public $year;

public $description;	
public $img_ref;

	 public function exchangeArray($data)
 {
 $this->name = (!empty($data['publisher'])) ? $data['publisher'] : null;
 $this->city = (!empty($data['city'])) ? $data['city'] : null;
 $this->country = (!empty($data['country'])) ? $data['country'] : null;

  $this->year = (!empty($data['year'])) ? $data['year'] : null;
  $this->description = (!empty($data['description'])) ? $data['description'] : null;
  $this->img_ref = (!empty($data['img_ref'])) ? $data['img_ref'] : null;
  $this->id = (!empty($data['id'])) ? $data['id'] : null;

 
 
 
 
 
 
 
 }
 
  public function getArrayCopy()
 {
 return get_object_vars($this);
 }
	
}













?>