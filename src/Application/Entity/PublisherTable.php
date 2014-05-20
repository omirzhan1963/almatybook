<?php
namespace Application\Entity;
use Zend\Db\ResultSet\ResultSet;
use Application\Entity\Publisheritem; 
use Application\Controller\Bookadapter;
 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Select;
 class PublisherTable
 {

 protected $publisherGateway;

 public function __construct()
 { $adapter=new Bookadapter();
	  $adapter=$adapter->getadapter();
 $resultSetPrototype = new ResultSet();
 $resultSetPrototype->setArrayObjectPrototype(new Publisheritem());
 $this->publisherGateway =new \Zend\Db\TableGateway\TableGateway('tblpublisher', $adapter, null, $resultSetPrototype); 
 }

 public function getpublisheritem($id)
 {
 $id = (int) $id;
 $rowset = $this->publisherGateway->select(array('id' => $id));
 $row = $rowset->current();
 if (!$row) {
 throw new \Exception("Could not find row $id");
 
 }
 return $row;
 }

 public function fetchAll()
 {
 
 $resultSet = $this->publisherGateway->select();
 return $resultSet;
 }


	



 public function savePublisheritem(Publisheritem $item)
 {
 $data = array( 'id' => $item->id,
  'publisher' => $item->name,
  'pos' => $item->position,
 
  
  
  
  
  
  
 );

 $id = (int) $item->id;
 if ($id == 0) {
 $this->publisherGateway->insert($data);
 } else {
 if ($this->getpublisheritem($id_Book)) {
 $this->publisherGateway->update($data, array('id' => $id));
 } else {
 throw new \Exception('Bookitem id does not exist');
 }
 }
 }

 public function deletePublisheritem($id)
 {
 $this->publisherGateway->delete(array('id' => (int) $id));
 }
 }
?>