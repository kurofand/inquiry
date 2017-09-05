<?php
// admin/inquiry_list.php
require_once( __DIR__ . '/init_auth.php');

//$page_num=(int)@$_GET['p'];
$page_num=abs((int)@$_GET['p']);
$per_page=10;

/*
if($where_array!==array())
{
	$buf=' WHERE '.implode(' and ',$where_array);
	$sql.=$sql;
	$sql_count.=$buf;
}
*/

$sort=(string)@$_GET['sort'];

$sort_white_list=array(
	'id'=>'inquiry_id', 
	'id_desc'=>'inquiry_id DESC', 
	'response_date'=>'response_date', 
	'response_date_desc'=>'response_date DESC'
	);

//if((sort!==='')&&(isset($sort_white_list[$sort])))
if((''===$sort)||(false===isset($sort_while_list[$sort])))
	$sort='id_desc';

$sort_sql_e=$sort_white_list[$sort];
$smarty_obj->assign('sort', $sort);

$find_string=array();
foreach(['name', 'email', 'birthday_from', 'birthday_to',] as $p)
	$find_string[$p]=(string)@$_GET[$p];
//var_dump($find_string);

$smarty_obj->assign('find_string', $find_string);

$awk=array();
foreach($find_string as $k =>$v)
	if($find_string[$k]!=='')
		$awk[]="{$k}=".rawurlencode($find_string[$k]);

$uri_params=implode('&', $awk);

$smarty_obj->assign('uri_params', $uri_params);

$dbh=get_dbh();

$bind_data=array(); 
$where_array=array(); 
// 一覧をDBから取得して 
// DBハンドルを取得 
$sql='SELECT * FROM inquirys ';
$sql_count='SELECT count(inquiry_id) FROM inquirys ';
if(''!==$find_string['email']) {
	//$sql=' WHERE email=:email';
	$where_array[]='email=:email';
	$bind_data[':email']=$find_string['email'];
}

if(''!==$find_string['name'])
{
	$where_array[]='name LIKE :name';
	$name_e=
		str_replace(	array('\\', '%', '_')
				, array('\\\\'. '\\%', '\\_')
				, $find_string['name']);
//	$bind_data[':name']="{$find_string['name']}%";
	$bind_data[':name']="{$name_e}%";
}

if('' !== $find_string['birthday_from'])
{
	if('' !== $find_string['birthday_to'])
	{
		$where_array[]='birthday BETWEEN :birthday_from AND :birthday_to';
		$bind_data[':birthday_from']=$find_string['birthday_from'];
		$bind_data[':birthday_to']=$fing_string['birthday_to'];
	}
	else
	{
		$where_array[]='birthday>=:birthday_from';
		$bind_data[':birthday_from']=$from_string['birthday_from'];
	}
}
else 
	if(''!==$find_string['birthday_to'])
	{
		$where_array[]='birthday <=:birthday_to';
		$bind_data[':birthday_to']=$find_string['birthday_to'];	
	}



if(array()!==$where_array)
{
	$buf=' WHERE '. implode(' and ', $where_array);
	$sql.=$buf;
	$sql_count.=$buf;
}

// プリペアドステートメント
$sql .= " ORDER BY {$sort_sql_e} LIMIT :limit_start ,:limit_num";
$sql_count.=" ;";

$bind_data_count=$bind_data;

$bind_data[':limit_start']=$page_num*$per_page;
$bind_data[':limit_num']=$per_page;

//var_dump($sql);
//var_dump($dbh);
$pre = $dbh->prepare($sql);
//var_dump($pre);
//var_dump($dbh->errorInfo());
// XXX 今回はバインドなし
// 実行
foreach($bind_data as $k=>$v)
	$pre->bindValue($k, $v);

$r = $pre->execute(); // XXX エラーチェック省略

// データを取得
$data = $pre->fetchAll(PDO::FETCH_ASSOC);

//$sql='SELECT count(inquiry_id) FROM inquirys;';
//$pre=$dbh->prepare($sql);
//var_dump($pre);
//$pre->execute();
//$rec_num=$pre->fetchAll();
//var_dump($data);

// テンプレートにデータを渡して
$smarty_obj->assign('inquiry_list', $data);
$pre_count=$dbh->prepare($sql_count);
//var_dump($pre_count);
foreach($bind_data_count as $k=>$v)
	$pre_count->bindValue($k, $v);
$r=$pre_count->execute();
$rec_num=$pre_count->fetchAll();
$rec_num=$rec_num[0][0];

// 表示

//$max_page_num=$rec_num/$per_page;
$max_page_num=ceil($rec_num/$per_page)-1;

$smarty_obj->assign('next_page',$page_num+1);
$smarty_obj->assign('back_page',$page_num-1);

$smarty_obj->assign('back_page_flg',(0===$page_num)?false:true);
$smarty_obj->assign('next_page_flg',($page_num>=$max_page_num)?false:true);

error_reporting(E_ALL & ~E_NOTICE);
$smarty_obj->display('admin/inquiry_list.tpl');


