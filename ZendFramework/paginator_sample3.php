<?php
//for test
include 'phar://zf.phar';

$frontendOptions = array(
   'lifetime' => 30, // キャッシュの有効期限
   'automatic_serialization' => true
);
$backendOptions = array(
    'cache_dir' => '/tmp/' // キャッシュファイルを書き込むディレクトリ
);
 
// Zend_Cache_Core オブジェクトを取得します
$cache = Zend_Cache::factory(
	'Function',
	'File',
	$frontendOptions,
	$backendOptions
);


$url = 'https://github.com/api/v2/json/commits/list/yandod/candycane/master';
$result = $cache->call('file_get_contents',array($url));

$array = json_decode(
	$result,
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