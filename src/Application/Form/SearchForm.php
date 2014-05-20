<?php

namespace Application\Form;
use Application\Entity\PublisherTable;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
class SearchForm extends Form
{
    public function __construct()
    {
        parent::__construct('search');
       $this->setAttribute('action', '/catalog');
        $this->setAttribute('method', 'post');
		 $this->setAttribute('class', 'navbar-form navbar-right');
		$pt=new PublisherTable();
		$publishers=$pt->fetchAll();
		$options=array();
		$options[0]='Все';
		foreach($publishers as $publisher)
		{
		$options[$publisher->id]=$publisher->name;	
			
		}
$this->add(array(     
    'type' => 'Zend\Form\Element\Select',       
    'name' => 'publisher',
    'attributes' =>  array(
        'id' => 'usernames', 
		'width'=>'100px',               
        'options' => $options
		
    ),
    'options' => array(
        'label' => 'Издательство',
    ),
));  
$optionyear=array();
$optionyear[1000]='Любой год';
 for($i=2013;$i>1924;$i--) $optionyear[$i]=$i;
$this->add(array(     
    'type' => 'Zend\Form\Element\Select',       
    'name' => 'year',
    'attributes' =>  array(
        'id' => 'year',                
        'options' => $optionyear
		
    ),
    'options' => array(
        'label' => 'Год издания',
    ),
)); 
         $this->add(array(
            'name' => 'author',
            'attributes' => array(
                'type'  => 'text',
              
				 'class'=>'form-control', 
    'placeholder'=>'Введите сюда автора книги'
            ),
			 'options' => array(
        'label' => 'Автор',
    ),
        ));
		$this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
              
				 'class'=>'form-control', 
    'placeholder'=>'Введите сюда название книги'
            ),
			 'options' => array(
        'label' => 'Название книги',
    ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Искать'
            ),
        ));
		 $inputFilter = new InputFilter();        
        $this->setInputFilter($inputFilter);
        
        $inputFilter->add(array(
                'name'     => 'author',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    array('name' => 'StripNewLines'),
                ),                
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )
        );
        $inputFilter->add(array(
                'name'     => 'name',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                    array('name' => 'StripNewLines'),
                ),                
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )
        );
        
        
       
    }
}







?>