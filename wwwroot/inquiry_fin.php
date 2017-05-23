<?php
ob_start();
session_start();

/*$email=(string)@$_POST['email'];
$email=(string)filter_input(INPUT_POST. 'email');*/

require_once(__DIR__.'/dbh.php');

$params=array('email', 'name', 'birthday', 'body');
$input_data=array();
foreach($params as $p)
	$input_data[$p]=(string)@$_POST[$p];

//var_dump($input_data);

$error_detail=array();

$posted_token=$_POST['csrf_token'];
var_dump($posted_token);
var_dump($_SESSION['csrf_token']);
var_dump($_SESSION);
//exit;


if(false===isset($_SESSION['csrf_token'][$posted_token]))
	$error_detail['error_csrf_token']=true;
else
{
	$ttl=$_SESSION['csrf_token'][$posted_token];
	if(time()>=$ttl+60)
		$error_detail['error_csrf_timeover']=true;
	unset($_SESSION['csrf_token'][$posted_token]);
}
	

$must_params=array('email', 'body');
foreach($must_params as $p)
	if(''===$input_data[$p])
		$error_detail["error_must_[$p]"]=true;
if(false===filter_var($input_data['email']. FILTER_VALIDATE_EMAIL))
	$error_detail["error_format_email"]=true;
if(''!==$input_data['birthday']);
	if(false==strtotime($input_data['birthday']))
		$error_detail["error_format_birthday"]=true;


if(array()!==$error_detail)
{
	$_SESSION['buffer']['error_detail']=$error_detail;
	$_SESSION['buffer']['input']=$input_data;
	//echo 'エラーがあったらしい';
	header('Location: ./inquiry.php');
	exit;
}

$dbh=get_dbh();

$sql='INSERT INTO inquirys(email, inquiry_body, name, birthday)
 VALUES(:email, :inquiry_body, :name, :birthday);';
$pre=$dbh->prepare($sql);
var_dump($pre);
var_dump($dbh->errorinfo());

$pre->bindValue(':email', $input_data['email']);
$pre->bindValue(':inquiry_body', $input_data['body']);
$pre->bindValue(':name', $input_data['name']);
$pre->bindValue(':birthday', $input_data['birthday']);

$r=$pre->execute();
if(!$r)
	echo'しみませんデータが取得出来ませんでした。';

//echo 'でーたのvalidateはOKでした';
