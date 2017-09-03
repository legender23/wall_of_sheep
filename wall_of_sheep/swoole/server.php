<?php
	$server=new swoole_websocket_server('0.0.0.0',9501);
	//$server->set(array('task_worker_num'=>4));
	$server->on('open',function(swoole_websocket_server $server,$request){
		echo 'connect from fd: '.$request->fd."\n";
	});
	$server->on('message',function(swoole_websocket_server $server,$frame){
		echo "get $frame->data from $frame->fd\n";
		$data=json_decode($frame->data,true);
		switch ($data[0]) {
			case '0':
				if($data[2]==="stu_wlan"){
					break;
				}
				if(strlen($data[2])!=0){
					$json_data=['type'=>$data[0],'src_mac'=>$data[1],'wifi_name'=>$data[2]];
				}
				break;
			
			case '1':
				$json_data=['type'=>$data[0],'src_mac'=>$data[1],'src_ip'=>$data[2],'dst_ip'=>$data[3],'url'=>$data[4],'cookie'=>!empty($data[5])?$data[5]:"****",'ua'=>$data[6]];
				break;
		}
		//$server->task($data);
	//	$content=$data['data'];
	//	$name=$data['name'];
		if(isset($json_data)){
			foreach ($server->connections as $each_client) {
				echo "send to $each_client\n";
				$server->push($each_client,json_encode($json_data));
			}
		}
	});
	$server->on('close',function($ser,$fd){
		echo "client $fd colse";
	});
	$server->on('task',function(swoole_websocket_server $server,$task_id,$from_id,$data){
		echo("task id: $task_id   from id: $from_id data:".json_encode($data));
		return "task id: $task_id";
	});
	$server->on('finish',function(swoole_websocket_server $server,$task_id,$data){
		echo "\n finish data : $data";
	});
	$server->start();
?>