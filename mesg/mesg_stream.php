<?php



$context = new ZMQContext();

$sock = $context->getSocket(ZMQ::SOCKET_SUB);
$sock->setSockOpt(ZMQ::SOCKOPT_SUBSCRIBE, "");
$sock->connect("tcp://127.0.0.1:5050");


 $msg = $sock->recv();
 $event = json_decode($msg, true);
 if (isset($event['type'])) {
        echo "event: {$event['type']}\n";
 }
 $data = json_encode($event['data']);



header('Content-Type: text/event-stream  charset=utf-8');
header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

/**
 * Constructs the SSE data format and flushes that data to the client.
 *
 * @param string $id Timestamp/id of this connection.
 * @param string $msg Line of text that should be transmitted.
 */
function sendMsg($id, $msg , $event) {
  echo "event: $event".PHP_EOL;
  echo "id: $id" . PHP_EOL;
  echo "data: $msg" . PHP_EOL;
  echo "retry: 10000" . PHP_EOL; 
  echo PHP_EOL;
  ob_flush();
  flush();
}

$serverTime = time();

$sessionID = session_id();
if(empty($sessionID)) session_start();

$sessionID =  session_id();


sendMsg($serverTime,  $data ,  'listernerMessage'. $sessionID);




