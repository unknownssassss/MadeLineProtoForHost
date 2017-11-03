<?php
	/* 
		sample:
		/Examples/API.php?phone=+989357973301&method=messages.getPeerDialogs&parms={"peers":["@WeCanGP"]}
	*/
	
	header('Content-Type: application/json');
	if(isset($_REQUEST['method']) && isset($_REQUEST['parms']) && isset($_REQUEST['phone'])){
		$ShowLog=false;
		require_once('UserLogin.php'); 
		$method = $_REQUEST['method'];
		$key = $phones[0]['number'];
		$MadelineProto[$key]->settings['updates']['handle_updates'] = false;
		$curdc = $MadelineProto[$key]->API->datacenter->curdc;
		$parms = json_decode($_REQUEST['parms'],true);
		$res = $MadelineProto[$key]->method_call($method, $parms, ['datacenter' => $curdc]);
		echo json_encode($res,JSON_PRETTY_PRINT);
	}else{
		echo '{"error":"need: method (string), parms (json encoded), phone (string)"}';
	}