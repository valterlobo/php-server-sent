<?php

$context = new ZMQContext();

$sock = $context->getSocket(ZMQ::SOCKET_SUB);
$sock->setSockOpt(ZMQ::SOCKOPT_SUBSCRIBE, "");
$sock->connect("tcp://127.0.0.1:5556");

echo "Receive"; 

while (true) {
    $msg = $sock->recv();
    $event = json_decode($msg, true);
    if (isset($event['type'])) {
        echo "event: {$event['type']}\n";
    }
    $data = json_encode($event['data']);
    echo "data: $data\n\n";
    ob_flush();
    flush();
}