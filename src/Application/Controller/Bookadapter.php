<?php
namespace Application\Controller;

use  Zend\Db\Adapter\Adapter as Adapter; 



class Bookadapter 
{
	public $adapter;
	public function getadapter()
	{
	$this->adapter=new Adapter(array(
        	'driver'    => 'pdo_mysql',
 		'dsn'       => 'mysql:dbname=booklist;host=localhost',
 		'database'  => 'booklist',
 		'username'  => 'omir',
 		'password'  => 'newpara46ABDR',
 		'hostname'  => 'localhost',
           
        ));	
		 $stmt=$this->adapter->createStatement('SET NAMES utf8');
        $res1=$stmt->execute();
		return $this->adapter;
		
	}
	
	
	
	
}
?>