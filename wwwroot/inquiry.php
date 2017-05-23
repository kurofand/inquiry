<?php 
ob_start();
session_start();

//$input=$_SESSION['buffer']['input'];
if(isset($_SESSION['buffer']['input']))
	$input=$_SESSION['buffer']['input'];
else
	$input=array();
if (true===isset($_SESSION['buffer']['error_detail']))
	$error_detail = $_SESSION['buffer']['error_detail'];
else
	$error_detail=array();

var_dump($error_detail);

//$error_detail=$_SESSION['buffer']['error_detail'];

$csrf_token=hash('sha512', random_bytes(128));

while(10<=count(@$_SESSION['csrf_token']))
	array_shift($_SESSION['csrf_token']);

$_SESSION['csrf_token'][$csrf_token]=time();

function h($a)
{
	return  htmlspecialchars($a, ENT_QUOTES);
}

var_dump($_SESSION);
?>
<html>
<body>
<?php
if(count($error_detail)>0)
	echo'<div style="color:red">エラーがあります</div>';
?>
<?php
if(isset($error_detail['error_must_email']))
	echo 'div style="color:red">メアドは必要です。</div>';
?>
<form action="./inquiry_fin.php" method="post">
email(*):<input type="text" name="email" value="
<?php echo h((string)@$input['email']);?>"><br>
名前<input type="text" name="name" value="<?php echo h((string)@$input['name']);?>"><br>
誕生日<input type="text" name="birthday" value="<?php echo h((string)@$input['birthday']);?>"><br>
問い合わせ内容<textarea name="body" value="
<?php 
echo h($input['textarea']);?>"></textarea><br>
<input type="hidden" name="csrf_token" value="<?php echo h($csrf_token);?>">
<button type="submit" name="button">問い合わせ</button>
</form>
<body>
</html>
