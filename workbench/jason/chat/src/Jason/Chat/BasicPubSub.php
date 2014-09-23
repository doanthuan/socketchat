<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 9/6/14
 * Time: 11:31 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Jason\Chat;


use Ratchet\ConnectionInterface as Conn;

/**
 * When a user publishes to a topic all clients who have subscribed
 * to that topic will receive the message/event from the publisher
 */
class BasicPubSub implements \Ratchet\Wamp\WampServerInterface {

    public $chatChannels = array();
    public $videoChannel = array();

    public $allSubscribers = array();

    public function onPublish(Conn $conn, $topic, $event, array $exclude, array $eligible) {
        $topic->broadcast($event);
    }

    public function onCall(Conn $conn, $id, $topic, array $params) {
        //$conn->callError($id, $topic, 'RPC not supported on this demo');
        //echo "onCall! ({$conn->resourceId}) {$id} {$topic} ".implode(",", $params)." \n";
        $this->allSubscribers[$conn->resourceId] = $params[0];
    }

    // No need to anything, since WampServer adds and removes subscribers to Topics automatically
    public function onSubscribe(Conn $conn, $topic) {
        echo "onSubscribe! ({$conn->resourceId})\n";

        $topicId = $topic->getId();
        if(strpos($topicId, 'video_') !== false){
            $this->videoChannel[$topicId] = $topic;
        }
        else{
            $this->chatChannels[$topicId] = $topic;
        }
    }
    public function onUnSubscribe(Conn $conn, $topic) {
    }

    public function onOpen(Conn $conn) {
        echo "New connection! ({$conn->resourceId})\n";
    }
    public function onClose(Conn $conn) {
        echo "Connection exit! ({$conn->resourceId})\n";

        if(isset($this->allSubscribers[$conn->resourceId])){
            $userId = $this->allSubscribers[$conn->resourceId];

            $user = \Jason\Chat\Models\User::find($userId);
            if($user){
                $user->closed_at = time();
                $user->save();
                $user->delete();
            }

            unset($this->allSubscribers[$conn->resourceId]);
        }

    }
    public function onError(Conn $conn, \Exception $e) {}
}