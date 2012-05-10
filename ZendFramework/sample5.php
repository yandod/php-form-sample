<?php
//for test
include 'phar://zf.phar';

class MyValidate implements Zend_Validate_Interface {
	public function isValid($value, $context = null) {
		if ( $value == '開けゴマ' ) {
			return true;
		}
		return false;
	}
	
	public function getMessages() {
		return array(
			'invalid' => '入力が正しくありません'
		);
	}
}

class MyForm extends Zend_Form {
	public function init() {		
		//populate form elements you need
		$input = new Zend_Form_Element_Text('q');

		//initialize validator
		$input->addValidator(new MyValidate());

		$this->addElement($input);
		$submit = new Zend_Form_Element_Submit('submit');
		$this->addElement($submit);
	}
}

//for test
$form = new MyForm();

//validate data on POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$ret = $form->isValid($_POST);
	
	if ($ret) {
		//save data on valid
		$data = $form->getValues();
		//some_save_function($data);
	}
}

$view = new Zend_View();
$form->q->removeDecorator('Label');
$form->q->removeDecorator('HtmlTag');
echo $form->q->render($view);
