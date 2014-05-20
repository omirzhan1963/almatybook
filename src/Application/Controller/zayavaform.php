<?php
namespace Application\Controller;

use Zend\Form\Form;

class zayavaform extends Form
{
public function __construct($name = null)
    {
parent::__construct('Zayava');
    	$this->setAttribute('method', 'post');
    	$this->setAttribute('enctype','multipart/form-data');
    	$this->setAttribute('action', 'zayava');
    	$this->add(array(
    			'name' => 'zayav',
    			'attributes' => array(
    					'type' => 'textarea',
    			    'required'=>'required',
    			),
    			'options' => array(
    					'label' => 'Веедите запрос',
    			),
    	));
    	$this->add(array(
    			'name' => 'email',
    			'attributes' => array(
    					'type' => 'email',
    			 
    			),
    			'options' => array(
    			    'label' => 'E-mail',
    			    ),
    			   
    	    'validators' => array(
    	    		 
    	    		array(
    	    
    	    				'name' => 'EmailAddress',
    	    				'options' => array(
    	    						'messages' => array(
    	    								\Zend\Validator\
    	    								EmailAddress::INVALID_FORMAT => 'Email address format is invalid'
    	    						)
    	    				)
    	    		)
    	    )
    			    ));
    	
    	$this->add(array(
    			'name' => 'telephone',
    			'attributes' => array(
    					'type' => 'text',
    			
    			),
    			'options' => array(
    					'label' => 'Телефон',
    			),
    	));
    	
    	$this->add(array(
    			'name' => 'userdata',
    			'attributes' => array(
    					'type' => 'text',
    			),
    			'options' => array(
    					'label' => 'Имя или ник',
    			),
    	));
    	
    	
    	
    	
    	
    	$this->add(array(
    			'name' => 'submit',
    			'attributes' => array(
    					'type'  => 'submit',
    					'value' => 'Отправить'
    			),
    	));
    
    }
}

?>