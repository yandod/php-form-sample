<?php
//for test
include 'phar://zf.phar';

class MyForm extends Zend_Form {
	public function init() {
		//initialize form
		$this->setAction('https://www.google.com/search');
		$this->setMethod('GET');
		
		//populate form elements you need
		$input = new Zend_Form_Element_Text('q');
		$this->addElement($input);
		$submit = new Zend_Form_Element_Submit('submit');
		$this->addElement($submit);
	}
}

//for test
$form = new MyForm();
$form->setView(new Zend_View());
echo $form->render();
