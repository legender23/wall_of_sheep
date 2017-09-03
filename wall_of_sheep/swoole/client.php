<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION['uname'])) {
		header("Location:index.php");
		exit();
	}
?>
<html lang="en">
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<title>swoole+websocket</title>
	<script type="text/javascript">
		var socket =new WebSocket("ws://0.0.0.0:9501");
		socket.onopen=function(event){
			//socket.send("connect");
		}
		socket.onmessage=function(event){
			//console.log(event.data);
			var talk=document.getElementById('talk');
			var p=document.createElement("p");
			p.innerHTML=event.data;
			talk.appendChild(p);
		}
		function send(){
			var word=document.getElementById('word');
			var name="<?php echo($_SESSION['uname']); ?>";
			var message={"data":word.value,"name":name};
			socket.send(JSON.stringify(message));
			//console.log(JSON.stringify(message));
			word.value="";
		}
	</script>
</head>
<body>
	<div class="container">
		<div class="panel panel-info">
			<div class="panel-body" id="talk">
				
			</div>
			<div class="panel-footer">
				<input type="text" name="word" id="word">
				<button class="btn btn-success" onclick="send();">发送</button>
			</div>
		</div>
	</div>
</body>
</html>