<?php 
ob_start();
session_start();

//$input=$_SESSION['buffer']['input'];
if(isset($_SESSION['buffer']['input']))
	$input=$_SESSION['buffer']['input'];
else
	$input=array();
$error_detail=$_SESSION['buffer']['error_detail'];

$csrf_token=hash('sha512', random_bytes(128));
while(10<=count(@$_SESSION['csrf_token']))
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
if(0<count($error_detail))
	echo'<div style="color:red">エラーがあります</div>';
?>
<?php
if(isset($error_detail['error_must_email']))
	echo 'div style="color:red">メアドは必要です。</div>';
?>
<form action="./inquiry_fin.php" method="post">
email(*):<input type="text" name="email" value="<?php echo h($input['email']);>?"><br>
名前<input type="text" name="name" value="<?php echo h($input['name']);?>"><br>
誕生日<input type="text" name="birthday" value="<?php echo h($input['birthday']);?>"><br>
問い合わせ内容<textarea name="body" value="
<?php 
echo h($input['body']);?>"></textarea><br>
<input type="hidden" name="csrf_token" value="<?php echo h($csrf_token);?>">
<button>問い合わせ</button>
</form>
<body>
</html>
