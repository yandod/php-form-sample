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

$result = $cache->call('date',array('Y-m-d H:i:s'));
var_dump($result);