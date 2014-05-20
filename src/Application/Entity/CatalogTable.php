<?php
namespace Application\Entity;
use Zend\Db\ResultSet\ResultSet;
use Application\Entity\Catalogitem; 
use Application\Controller\Bookadapter;
 use Zend\Db\TableGateway\TableGateway;
 class CatalogTable
 {

 protected $catalogGateway;
 public function __construct()
 {
	 $adapter=new Bookadapter();
	  $adapter=$adapter->getadapter();
 $resultSetPrototype = new ResultSet();
 $resultSetPrototype->setArrayObjectPrototype(new Catalogitem());
 $this->catalogGateway =new \Zend\Db\TableGateway\TableGateway('system_catalog', $adapter, null, $resultSetPrototype); 
 }

 public function fetchAll()
 {
 $resultSet = $this->catalogGateway->select();
 return $resultSet;
 }

 public function getCatalogitem($id_catalog)
 {
 $id_catalog = (int) $id_catalog;
 $rowset = $this->catalogGateway->select(array('id_catalog' => $id_catalog));
 $row = $rowset->current();
 if (!$row) {
 throw new \Exception("Could not find row $id");
 
 }
 return $row;
 }
public function getsection($id_section)
{$id_section = (int) $id_section;
 $rowset = $this->catalogGateway->select(array('id_section' => $id_section));
return $rowset;	
	
}
 public function saveCatalogitem(Catalogitem $item)
 {
 $data = array( 'id_catalog' => $item->id_catalog,
  'name_section' => $item->name_catalog,
  'id_section' => $item->id_section,
 );

 $id_catalog = (int) $item->id_catalog;
 if ($id_catalog == 0) {
 $this->catalogGateway->insert($data);
 } else {
 if ($this->getCatalogitem($id_catalog)) {
 $this->catalogGateway->update($data, array('id_catalog' => $id_catalog));
 } else {
 throw new \Exception('Catalogitem id does not exist');
 }
 }
 }

 public function deleteCatalogitem($id_catalog)
 {
 $this->catalogGateway->delete(array('id_catalog' => (int) $id_catalog));
 }
 }
?>