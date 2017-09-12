<?php

$context = new ZMQContext();
$pull = $context->getSocket(ZMQ::SOCKET_PULL);
$pull->bind("tcp://127.0.0.1:5555");

$pub = $context->getSocket(ZMQ::SOCKET_PUB);
$pub->bind("tcp://127.0.0.1:5050");


while (true) {
    $msg = $pull->recv();
    echo "pub received message $msg\n";
    //$msg_result = executar_tarefa($msg);
    $pub->send($msg);
}
