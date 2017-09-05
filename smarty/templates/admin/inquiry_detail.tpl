<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg320mUcww7on3RYdg4Va+PmSTsz/K68vdbEjh4u" crossorigin="anonimous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nDOJutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonimous">

</head>
<body>
<div class="container">
{$inquiry_data|var_dump}

<table class="table">
<tr>
	<td>id</td>
	<td>{$inquiry_data.inquiry_id}</td>	
</tr>
<tr>
        <td>email</td>
        <td>{$inquiry_data.email}</td>
</tr>
<tr>
        <td>name</td>
        <td>{$inquiry_data.name}</td>
</tr>
<tr>
        <td>birthday</td>
        <td>{$inquiry_data.birthday}</td>
</tr>
<tr>
        <td>body</td>
        <td>{$inquiry_data.body}</td>
</tr>
</table>
<h2>未実装</h2>
<ul>
<li>返信をメールする</li>
<li>返信のステータス</li>
</ul>
<a href="./top.php">Top</a>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonimous"></script>
</div>
</body>
</html>
