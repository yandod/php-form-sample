<?php
//for test
include 'phar://zf.phar';

//initialize form
$form = new Zend_Form();
$form->setAction('https://www.google.com/search');
$form->setMethod('GET');

//populate form elements you need
$input = new Zend_Form_Element_Text('q');
$form->addElement($input);
$submit = new Zend_Form_Element_Submit('submit');
$form->addElement($submit);

//for test
$form->setView(new Zend_View());
echo $form->render();
