<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require 'start.php';

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


$showTime = \Jason\Chat\Helper::getShowTime();
$loop->addPeriodicTimer(2, function () use (&$handler, &$showTime){
    if(time() > $showTime){
        echo "Starting video show...\n";

        $showTime = \Jason\Chat\Helper::getShowTime();

        $videoChannel =& $handler->videoChannel;
        $channel = array_shift($videoChannel);

        //clear trash
        \Jason\Chat\Models\User::onlyTrashed()->forceDelete();

        if($channel)
        {
            $queueNumber = substr($channel, strlen('video_'));
            if(!is_numeric($queueNumber)){
                throw new \Exception('Error when starting video show. Invalid current queue number');
                exit;
            }

            //make couple for show
            \Jason\Chat\Helper::makeCouple($queueNumber);

            //delete current waiting queue
            \Jason\Chat\Models\User::where('queue_number', $queueNumber)->delete();

            //start video
            $channel->broadcast('start');
        }
    }
});

$endTime = \Jason\Chat\Helper::getEndTime($showTime);
$loop->addPeriodicTimer(5, function () use (&$handler, &$endTime){
    if(time() > $endTime){
        echo "Terminate chat application...\n";

        $chatChannels = $handler->chatChannels;
        foreach($chatChannels as $channel){
            $channel->broadcast('end-chat');
        }
        $handler->chatChannels = array();

        $showTime = \Jason\Chat\Helper::getShowTime();
        $endTime = \Jason\Chat\Helper::getEndTime($showTime);
    }
});

$loop->run();




//$server = new \Ratchet\App('socketchat.local', 19888, '0.0.0.0');
//$server->route('', new \Jason\Chat\BasicPubSub, array('*'));
//$server->run();

