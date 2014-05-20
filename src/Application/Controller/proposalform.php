<?php
namespace Application\Controller;

use Zend\Form\Form;

class proposalform extends Form
{public function __construct($name = null)
    {
parent::__construct('Feedback');
    	$this->setAttribute('method', 'post');
    	$this->setAttribute('enctype','multipart/form-data');
    	$this->setAttribute('action', 'feedback');
    	$this->add(array(
    			'name' => 'proposal',
    			'attributes' => array(
    					'type' => 'textarea',
    			    'required'=>'required',
    			),
    			'options' => array(
    					'label' => 'Оставьте предложение или пожелание',
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