<?php
//class ChatServer
//{
//    protected $signature = 'chat:server {action} {--daemon}';
//
//    public function handle()
//    {
//        $this->initProcess();
//        Worker::runAll();
//    }
//
//    private function initProcess()
//    {
//        // Gateway进程
//        $gateway = new Gateway("websocket://0.0.0.0:7272");
//        $gateway->name = 'ChatGateway';
//        $gateway->count = 4;
//        $gateway->pingInterval = 55;
//        $gateway->pingData = '{"type":"ping"}';
//        $gateway->registerAddress = '127.0.0.1:1236';
//
//        // BusinessWorker进程
//        $worker = new BusinessWorker();
//        $worker->eventHandler = \App\Events\ChatEvent::class;
//        $worker->registerAddress = '127.0.0.1:1236';
//
//        // Register服务
//        new Register('text://0.0.0.0:1236');
//    }
//
//}
