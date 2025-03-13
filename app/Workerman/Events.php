<?php

class Events
{
// app/Workerman/Events.php
    public static function onMessage($client_id, $message)
    {
        $data = json_decode($message, true);
        switch ($data['type']) {
            case 'chat':
                Gateway::sendToClient($data['to'], json_encode([
                    'from' => $data['from'],
                    'content' => $data['content']
                ]));
                break;
        }
    }

    public static function onWebSocketConnect($client_id) {
        $token = $_GET['token'];
        $user = User::where('api_token', $token)->first();
        if ($user) {
            $_SESSION['user_id'] = $user->id;
        }
    }
}
?>
