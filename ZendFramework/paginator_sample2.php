<?php
//for test
include 'phar://zf.phar';

$url = 'https://github.com/api/v2/json/commits/list/yandod/candycane/master';
$array = json_decode(
	file_get_contents($url),
	true
);

$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($array['commits']));

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$paginator->setCurrentPageNumber($page);

foreach ($paginator as $row) {
	echo $row['message'];
	echo '<hr>';
}
Zend_View_Helper_PaginationControl::setDefaultViewPartial(
    'pagination.phtml'
);
$view = new Zend_View();
$view->setScriptPath(dirname(__FILE__));
echo $paginator->render(
	$view
);