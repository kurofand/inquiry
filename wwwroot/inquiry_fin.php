<?php
ob_start();
session_start();
/*$email=(string)@$_POST['email'];
$email=(string)filter_input(INPUT_POST. 'email');*/
$params=array('email', 'name', 'birthday', 'body');
$input_data=array();
foreach($params as $p)
	$input_data[$p]=(string)@$_POST[$p];
var_dump($input_data);
$error_detail=array();
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
echo 'でーたのvalidateはOKでした';
