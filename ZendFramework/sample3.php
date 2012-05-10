<?php
//for test
include 'phar://zf.phar';

class MyForm extends Zend_Form {
	public function init() {		
		//populate form elements you need
		$input = new Zend_Form_Element_Text('q');

		//initialize validator
		$alnum = new Zend_Validate_Alnum(array(
			'allowWhiteSpace' => true
		));
		$alnum->setMessage(
			'英数字で入力してください',
			Zend_Validate_Alnum::NOT_ALNUM
		);
		$input->addValidator($alnum);

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
$form->setView(new Zend_View());
echo $form->render();
