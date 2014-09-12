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

    public $subscribedTopics = array();

    public function onPublish(Conn $conn, $topic, $event, array $exclude, array $eligible) {
        $topic->broadcast($event);
    }

    public function onCall(Conn $conn, $id, $topic, array $params) {
        $conn->callError($id, $topic, 'RPC not supported on this demo');
    }

    // No need to anything, since WampServer adds and removes subscribers to Topics automatically
    public function onSubscribe(Conn $conn, $topic) {
        $this->subscribedTopics[$topic->getId()] = $topic;
    }
    public function onUnSubscribe(Conn $conn, $topic) {}

    public function onOpen(Conn $conn) {
        echo "New connection! ({$conn->resourceId})\n";
    }
    public function onClose(Conn $conn) {}
    public function onError(Conn $conn, \Exception $e) {}
}