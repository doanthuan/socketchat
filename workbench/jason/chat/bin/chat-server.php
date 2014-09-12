<?php
require dirname(__DIR__) . '/vendor/autoload.php';

//$pusher = new \Jason\Chat\Pusher;
$loop   = React\EventLoop\Factory::create();
$handler =  new \Jason\Chat\BasicPubSub();

// Listen for the web server to make a ZeroMQ push after an ajax request
//$context = new React\ZMQ\Context($loop);
//$pull = $context->getSocket(ZMQ::SOCKET_PULL);
//$pull->bind('tcp://127.0.0.1:5555'); // Binding to 127.0.0.1 means the only client that can connect is itself
//$pull->on('message', array($pusher, 'onBlogEntry'));

// Set up our WebSocket server for clients wanting real-time updates
$webSock = new React\Socket\Server($loop);
$webSock->listen(19888, '0.0.0.0'); // Binding to 0.0.0.0 means remotes can connect
$webServer = new Ratchet\Server\IoServer(
    new Ratchet\Http\HttpServer(
        new Ratchet\WebSocket\WsServer(
            new Ratchet\Wamp\WampServer(
                $handler
            )
        )
    ),
    $webSock
);

$showTime = getShowTime();
$loop->addPeriodicTimer(2, function () use (&$handler, &$showTime){
//    $memory = memory_get_usage() / 1024;
//    $formatted = number_format($memory, 3).'K';
//    echo "Current memory usage: {$formatted}\n";
    //echo "time:".time()."\n";
    //echo "showTime:".$showTime."\n";
    if(time() > $showTime){
        echo "Starting video show...\n";
        $showTime = getShowTime();
        $subscribedTopics = $handler->subscribedTopics;
        if(isset($subscribedTopics['video'])){
            $videoChannel = $subscribedTopics['video'];
            $videoChannel->broadcast('start');
        }
    }
});

$loop->run();

function getShowTime()
{
    $period = 1;
    $curMin = date('i');
    $addMin = intval($curMin/$period) * $period + $period;
    $time = strtotime(date('Y-m-d H:00:00'));
    $showTime = strtotime('+'.$addMin.' minutes', $time);
    return $showTime;
}
//$server = new \Ratchet\App('socketchat.local', 19888, '0.0.0.0');
//$server->route('', new \Jason\Chat\BasicPubSub, array('*'));
//$server->run();

