{* inquiry_list.tel *}
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>

<body>
<div class="container">

<h1>問い合わせ一覧</h1>
{* $inquiry_list|var_dump *}

<h2>検索：</h2><br>
{if($back_page_flg)}
<a href="./inquiry_list.php?sort=[$sort]&[$uri_params|unescape&p=[$back_page]]">back</a>
{else}
   
{/if}

{if $next_page_flg}
	<a href="./inquiry_list.php?sort={$sort}&{$uri_params|unescape&p=[$next_page]}">back</a>
{/if}
<a href="/inquiry=list.php?sort=[$sort]&[$uri_params|unescape&p=[$next_page]]">next</a>
<form action="./inquiry_list.php" method="GET">
<input type="hidden" name="sort" value="{$sort}">
name<input name="name" value="{$find_string.name}"><br>
email<input name="email" value="{$find_string.email}"><br>
<input name="birthday_from" value="{$find_string.birthday_from}">~<input name="birthday_to" value="{$find_string.birthday_to}"><br>
<br>
</form>
<table class="table table-hover">
<tr>
  <th>ID<a href='./inquiry_list.php?sort=id'>▲</a><a href='./inquiry.php?sort=id_desc'>▲▼ </a>
	<th>名前<a href=''> </aa<a href=''>▼ </a>
	<th>email<a href=''> </aa<a href=''>▼ </a>
  <th>問い合わせ内容
	<th>返信日時<a href=''> </aa<a href=''>▼ </a>
{foreach from=$inquiry_list item=i}
  <tr>
    <td>{$i.inquiry_id}
	<td>{$i.name}
	<td>{$i.email}
    <td>{$i.inquiry_body}
	<td>{$i.response_date}
    <td><a href="./inquiry_detail.php?inquiry_id={$i.inquiry_id|urlencode}" class="btn btn-nomal">問い合わせ詳細</a>
{/foreach}
</table>

<hr>
<a href="./top.php">Topに戻る</a>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</div>
</bod>
</html>
