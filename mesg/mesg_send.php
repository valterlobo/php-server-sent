<?php


$context = new ZMQContext();

$sock = $context->getSocket(ZMQ::SOCKET_PUSH);
$sock->connect("tcp://127.0.0.1:5555");
$sessionID = session_id();
if(empty($sessionID)) session_start();

$sessionID =  session_id();

//$msg_post = json_encode($_POST);

$msg = json_encode(array('type' => 'calculaPrevisao' , 'data' =>$_POST , 'session' =>$sessionID ));

$sock->send($msg);



echo $msg;