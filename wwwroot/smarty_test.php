<?php
require_once(__DIR__.'/vendor/smarty-3.1.30/libs/Smarty.class.php');

$smarty_obj=new Smarty();
//var_dump($smarty_obj);

$smarty_obj->setTemplateDir(__DIR__.'/../smarty/templates/');
$smarty_obj->setCompileDir(__DIR__.'/../smarty/templates_c/');

$s='データ入力テスト';
$smarty_obj->assign('val', $s);

$awk['a']='配列のa';
$awk['b']='配列のb';
$smarty_obj->assign('ar', $awk);

$smarty_obj->display('smarty_test.tpl');

echo 'horosho';
?>
