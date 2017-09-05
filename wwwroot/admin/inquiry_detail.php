<?php

require_once (__DIR__.'/init_auth.php');

$inquiry_id=(string) @$_GET['inquiry_id'];
if(''===$inquiry_id)
{
	header('Location:../inquiry_list.php');
	exit;
}

$dbh=get_dbh();

//$sql='SELECT * FROM inquirys WHERE inquiry_id= :inquiry_id';

$sql='UPDATE inquirys SET status=2, response_body=:response_body,response_date=:response_date WHERE inquiry?id=:inquiry_id;';

$pre=$dbh->prepare($sql);

$pre->bindValue(':response_body', $input_data['response_body']);
$pre->bindValue(':response_date', date('Y-m-d H:i:s'));
$pre->bindValue(':inquiry_id', $inquiry_id);

$r=$pre->execute();

header('Location: inquiry_detail.php?inquiry_id='.rawurlencode($input_data['inquiry_id']));

/*$data=$pre->fetchAll(PDO::FETCH_ASSOC);

if(!$data)
{
	header('Location:./inquiry_list.php');
	exit;
}

$smarty_obj->assign('inquiry_data', data);
error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('admin/inquiry_detail.tpl');
*/
