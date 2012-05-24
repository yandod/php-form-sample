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
	'Core',
	'File',
	$frontendOptions,
	$backendOptions
);

if( ($result = $cache->load('myresult')) === false ) {
	$result =  date('Y-m-d H:i:s'); 
	$cache->save($result, 'myresult');
} else {
    echo "キャッシュにヒット<br/>\n";
}
var_dump($result);