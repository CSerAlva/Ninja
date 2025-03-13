<?php

use GatewayWorker\Lib\Gateway;

class ChatEvent
{
    public static function onConnect($client_id)
    {
        Gateway::sendToClient($client_id, json_encode([
            'type' => 'system',
            'msg' => '连接成功，ID:' . $client_id
        ]));
    }

    public static function onMessage($client_id, $message)
    {
        $data = json_decode($message, true);

        // 消息广播
        Gateway::sendToAll(json_encode([
            'from' => $client_id,
            'content' => htmlspecialchars($data['content']),
            'time' => date('Y-m-d H:i:s')
        ]));
    }
}
