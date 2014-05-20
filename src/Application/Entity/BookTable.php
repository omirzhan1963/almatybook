<?php
namespace Application\Entity;
use Zend\Db\ResultSet\ResultSet;
use Application\Entity\Bookitem; 
use Application\Controller\Bookadapter;
 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Select;
 use  Zend\Db\Sql\Where;
    
   

 
 class BookTable
 {

 protected $BookGateway;
 protected $adapter;

 public function __construct()
 {
	
	 $adapter=new Bookadapter();
	  $this->adapter=$adapter->getadapter();
 $resultSetPrototype = new ResultSet();
 $resultSetPrototype->setArrayObjectPrototype(new Bookitem());
 $this->BookGateway =new \Zend\Db\TableGateway\TableGateway('system_position', $this->adapter, null, $resultSetPrototype); 
 }


 public function fetchAll()
 {
	 $select=new Select('system_position');
$select->where(array('hide'=>'show'));
  $select->limit(30);
 $resultSet = $this->BookGateway->selectwith($select);
 return $resultSet;
 }
public function getmaxprev($id_catalog,$selectstr)
{
	$query="id_catalog=$id_catalog and hide='show'  ".$selectstr."  order by id_position desc limit 301"  ;
 $resultSet = $this->BookGateway->select($query);
 $i=0;
 $maxprev=0;
foreach ($resultSet as $book)
{
	if ($i==0) 
	{
	  $maxprev=$book->id;
	  $i+=1;
		
	}
if ($maxprev<$book->id)
$maxprev=$book->id;


} 
return $maxprev;

	
}
 public function getBookitem($id_Book)
 {
 $id_Book = (int) $id_Book;
 $rowset = $this->BookGateway->select(array('id_position' => $id_Book));
 $row = $rowset->current();
 if (!$row) {
 throw new \Exception("Could not find row $id");
 
 }
 return $row;
 }
public function getcatalog($cat,$prev,$selectstr='')
{
$select=new Select('system_position');
$query="id_catalog=$cat and id_position>$prev and hide='show'   ".$selectstr."  order by id_position limit 30"  ;

 $resultSet = $this->BookGateway->select($query);
	// $resultSet = $this->BookGateway->selectwith($this->select);
 return $resultSet;
	
}

public function getprevsingle($prev,$id_catalog,$selectstr)
{
$res=$this->getcatalog($id_catalog,$prev,$selectstr);
$i=0;
$newprev=-1;
foreach ($res as $book)
{$i+=1;
if ($i==1){$newprev=$book->id;} 
if ($newprev<$book->id){$newprev=$book->id;} 

}
if (($i<30)) $newprev=-1;
return $newprev;	
}
public function getprevminussingle($prev,$id_catalog,$selectstr)
{
$query="id_catalog=$id_catalog and id_position<$prev and hide='show'   ".$selectstr."  order by id_position  DESC limit 30"  ;	

 $res = $this->BookGateway->select($query);
	
	
	

$i=0;
$newprev=-1;
foreach ($res as $book)
{$i+=1;
if ($i==1){$newprev=$book->id;} 
if ($newprev>$book->id){$newprev=$book->id;} 

}
if (($i<30)&&($newprev>0)) $newprev=0;
return $newprev;	
}
public function getprevplus($prev,$page,$id_catalog,$selectstr='')
{
$res=array();
for ($i=0;$i<6;$i++)
{
$newprev=$this->getprevsingle($prev,$id_catalog,$selectstr);
if ($newprev>0){
$page=$page+1;
$res[$page]=$newprev;
$prev=$newprev;
	
}
}
return $res;	
}

public function getprevminus($prev,$page,$id_catalog,$selectstr='')
{
	
$res=array();
for ($i=0;$i<6;$i++)
{
$newprev=$this->getprevminussingle($prev,$id_catalog,$selectstr);
if ($newprev>-1){
$page=$page-1;
$res[$page]=$newprev;
$prev=$newprev;
	
}
}
return $res;	
}
public function getprev($prev,$page,$id_catalog,$selectstr)
{$res1=$this->getprevminus($prev,$page,$id_catalog,$selectstr);

$minp=$page;
$countmin=count($res1);
foreach($res1 as $p=>$pr)
{if ($p<$minp) $minp=$p;

}
$res1[$page]=$prev;
$res2=$this->getprevplus($prev,$page,$id_catalog,$selectstr);
$countplus=count($res2);
$maxp=$page;
foreach($res2 as $p=>$pr)
{if ($p>$maxp) $maxp=$p;
$res1[$p]=$pr;
}	
$res1['maxp']=$maxp;
$res1['minp']=$minp;
$res1['maxprev']=$this->getmaxprev($id_catalog,$selectstr);

return $res1;	
}

 public function saveBookitem(Bookitem $item)
 {
 $data = array( 'id_position' => $item->id,
  'name' => $item->name,
  'id_catalog' => $item->id_catalog,
  'author'=>$item->author,
  'publisher'=>$this-publisher,
   'year'=>$this->year,
   'price'=>$this->price,
   'condition'=>$this->condition,
  
  
  
  
  
  
 );

 $id_Book = (int) $item->id;
 if ($id_Book == 0) {
 $this->BookGateway->insert($data);
 } else {
 if ($this->getBookitem($id_Book)) {
 $this->BookGateway->update($data, array('id_position' => $id_Book));
 } else {
 throw new \Exception('Bookitem id does not exist');
 }
 }
 }

 public function deleteBookitem($id_Book)
 {
 $this->BookGateway->delete(array('id_position' => (int) $id_Book));
 }
 }
?>?>