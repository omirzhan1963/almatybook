<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Navigation\Navigation as navigationmy;
use Application\Controller\zayavaform as zayavaform;
use Application\Controller\proposalform as feedbackform;
use Application\Entity\SectionTable;
use Application\Form\SearchForm;
use Zend\Db\Sql\Select;
use Application\Entity\BookTable;
use Application\Entity\PublisherTable;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
$f=fopen('log1.txt','w');
if (isset($f)) $t='66';else $t='0';
fwrite($f,'888');
fclose($f);
        return new ViewModel(array('t'=>$t));
    }
    public  function catalogAction()
    {
       $query='';
		$form=new SearchForm();
	if ($this->request->ispost()) {$post=$this->request->getpost();
	//$postclass=get_class($post);
	$form->setData($post);
	if ($form->isValid()) $fv=true;
	
	$publisher=($post['publisher'])? $post['publisher'] :'';
	$year=($post['year'])?$post['year']:'';
	$name=($post['name'])?$post['name']:'';
	$author=($post['author'])?$post['author']:'';
	if ((strlen($publisher)>0)&&($publisher!=0)) $query=$query." and id_publisher=$id_publisher ";
	if ((strlen($year)>0)&&($year!=1000)) $query=$query." and year=$year ";
	if (strlen($name)>0) $query=$query." and name like '".$name."%' ";
		if (strlen($author)>0) $query=$query." and author like \"".$author."%\" ";
	
	
	
	
	
	
	
	}

	$prev=0;$page=1;
		$cat=1;


		$cat1=$this->request->getRequestUri() ;
		$cat2=explode('/',$cat1);
		if (count($cat2)>2)$cat=$cat2[2];else $cat=1;
			if (count($cat2)>4){$prev=$cat2[3];$page=$cat2[4];}else {$prev=0;$page=1;}
		
		$bt=new BookTable();
	
	$prevplus=$bt->getprev($prev,$page,$cat,$query);
		$books=$bt->getcatalog($cat,$prev,$query);
		$sections=new SectionTable();
		$sectionrow=$sections->fetchAll();
		 $viewModel = new ViewModel(array('sections'=>$sectionrow,'books'=>$books,'form'=>$form,'uri'=>$cat2,'prevplus'=>$prevplus,'id_catalog'=>$cat,));
        $viewModel->setTerminal(true);
        return $viewModel;
        
    }
    public  function  zayavaAction()
    {
      $form=new zayavaform();
      if (!$this->request->isPost()) {        
        $vm=new ViewModel(array('form'=>$form));
        return $vm;}
        $post = $this->request->getPost();
    
        $form->setData($post);
     if (!$form->isValid()) {
        		$vm = new ViewModel(array(
        				'error' => true,
        				'form' => $form,
        		    
        		));
    return $vm;
     }
     $mf= new MyFunc;
     $zayav=$this->getRequest()->getPost('zayav');
     $zayav=$mf->utfstrtonumstr($zayav);
     $email=$this->getRequest()->getPost('email');
     if (!empty($email)) $email=$mf->utfstrtonumstr($email);
     $telephone=$this->getRequest()->getPost('telephone');
     if (!empty($telephone)) $telephone=$mf->utfstrtonumstr($telephone);

     
     $adapter= new \Zend\Db\Adapter\Adapter(array(
     		'driver'    => 'pdo_mysql',
     		'dsn'       => 'mysql:dbname=booklist;host=localhost',
     		'database'  => 'booklist',
     		'username'  => 'omir',
     		'password'  => 'newpara46ABDR',
     		'hostname'  => 'localhost',
     
     ));
    // $dat=now();'putdate'=>$dat
     $gate=new \Zend\Db\TableGateway\TableGateway('system_zayava', $adapter );
     $gate->insert(array('zayava'=>$zayav,'email'=>$email,'telephone'=>$telephone,));
     
     return $this->redirect()->toRoute('home');
        
    }
    public  function  topAction()
    {$vm=new ViewModel();
    return $vm;
    
    
    }

     
     public  function  feedbackAction()
    {$form=new feedbackform();
      if (!$this->request->isPost()) {        
        $vm=new ViewModel(array('form'=>$form));
        return $vm;}
        $post = $this->request->getPost();
    
        $form->setData($post);
     if (!$form->isValid()) {
        		$vm = new ViewModel(array(
        				'error' => true,
        				'form' => $form,
        		    
        		));
    return $vm;
     }
     $mf= new MyFunc;
     $proposal=$this->getRequest()->getPost('proposal');
 $proposal=$mf->utfstrtonumstr($proposal);
 $email=$this->getRequest()->getPost('email');
 if (!empty($email)) $email=$mf->utfstrtonumstr($email);
 $telephone=$this->getRequest()->getPost('telephone');
if (!empty($telephone)) $telephone=$mf->utfstrtonumstr($telephone);
 $userdata=$this->getRequest()->getPost('userdata');
if (!empty($userdata)) $userdata=$mf->utfstrtonumstr($userdata);
 
 $adapter= new \Zend\Db\Adapter\Adapter(array(
 		'driver'    => 'pdo_mysql',
 		'dsn'       => 'mysql:dbname=booklist;host=localhost',
 		'database'  => 'booklist',
 		'username'  => 'omir',
 		'password'  => 'newpara46ABDR',
 		'hostname'  => 'localhost',
 		 
 ));
 $gate=new \Zend\Db\TableGateway\TableGateway('feedback', $adapter );
$gate->insert(array('proposal'=>$proposal,'email'=>$email,'telephone'=>$telephone,'userdata'=>$userdata));
 
     
     return $this->redirect()->toRoute('home');
        
    
    
    }

 public function showformAction()
    {$id=$this->request->getPost('id_catalog');
    $prev=$this->request->getPost('previos');
        $adapter= new \Zend\Db\Adapter\Adapter(array(
 		'driver'    => 'pdo_mysql',
 		'dsn'       => 'mysql:dbname=booklist;host=localhost',
 		'database'  => 'booklist',
 		'username'  => 'omir',
 		'password'  => 'newpara46ABDR',
 		'hostname'  => 'localhost',
 		 
 ));


        $stmt=$adapter->createStatement('SET NAMES utf8');
        $res1=$stmt->execute();
    
        $sql11 = new \Zend\Db\Sql\Sql($adapter);
       
       $select= $sql11->select('system_position');
       $select->where("id_catalog=$id and id_position>$prev");
       //id_catalog=>$id and
       $select->order('id_position');
       $select->limit(30);
       $stmt=$sql11->prepareStatementForSqlObject($select);
       $res=$stmt->execute();
       $str="";
       foreach ($res as $row)
       {$str.="<tr><td>".$row['name']."</td><td>".$row['author']."</td><td>".$row['description']."</td></tr>";}
       //"</td><td>".$row['description'].
   
       
        $this->response->setContent($str);
    
  $f=fopen('log1.txt','w');
fwrite($f,'hhhhh');
fclose($f);
    	
    	return  $this->response;
    }
    
}