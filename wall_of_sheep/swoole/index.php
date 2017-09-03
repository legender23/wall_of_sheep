<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<title>Index</title>
</head>
<body>
	<div class="container">
		<div class="panel panel-info col-sm-6 col-lg-6 col-xl-6 col-md-6">
			<div class="panel-heading">
				<h3>给自己起个名字吧</h3>
			</div>
			<div class="panel-body">
				<form action="" method="post" class="">
					<div class="input-group">
						<span class="glyphicon glyphicon-pencil input-group-addon" style="color: rgb(0, 115, 138);"></span>
						<input type="text" class="form-control" name="uname" placeholder="用户名">
					</div>
					<div class="input-group">
						<input type="submit" name="submit" class="form-control btn btn-info" value="确定">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<?php
session_start();
if (isset($_POST['submit'])) {
	$_SESSION['uname']=addslashes($_POST['uname']);
	header("Location:client.php");
}

?>
</html>