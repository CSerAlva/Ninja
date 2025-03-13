<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTask;
use App\Services\RabbitMQService;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

//在你的控制器或服务中，使用 RabbitMQService 来发送消息
class RabbitMQController extends BaseController
{
    public function sendMessage(Request $request)
    {
        $message = "Hello, RabbitMQ!"; // 要发送的消息内容。
        $rabbitMQService = new RabbitMQService(); // 使用上面创建的服务类。
        $rabbitMQService->publish($message); // 发送消息。
        return response()->json(['status' => 'Message sent successfully']); // 返回响应。
    }

    //Zy 生产者向消息队列中添加数据
    public function msg()
    {
        //docker run -d -p 5672:5672 -p 15672:15672 --name rabbitmq rabbitmq:management
        //5672 是 RabbitMQ 的服务端口，15672 则是它自带的一个管理工具的访问端口。

        // 建立连接
        $connection = new AMQPStreamConnection('localhost', 5672, 'Alva', '597683');
        $channel = $connection->channel(); // 获取频道
        // 定义队列
        $channel->queue_declare('hello', false, false, false, false);
        // 创建消息
        $msg = new AMQPMessage('Hello World!');
        $channel->basic_publish($msg, '', 'hello'); // 将消息放入队列中

        echo "生产者向消息队列中发送信息：Hello World！";

        $channel->close();
        $connection->close();
    }

    //Zy 消费者/客户端实现
    public function test()
    {
        ProcessTask::dispatch();
        // 建立连接
        $connection = new AMQPStreamConnection('localhost', 5672, 'Alva', '597683');
        $channel = $connection->channel(); // 获取频道

//    dd($channel);

        // 定义队列
        $channel->queue_declare('hello', false, false, false, false);

        echo "等待消息，或者使用 Ctrl+C 退出程序。", PHP_EOL;

        // 定义接收数据的回调函数
        $callback = function ($msg) {
            echo '接收到数据：', $msg->body, PHP_EOL;
        };

        // 消费队列，获取到数据将调用 callback 回调函数
        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        // 频道是开启状态时，挂起程序，不停地执行
        while ($channel->is_open()) {
            // 等待并监听频道中的队列信息
            // 发现上方 basic_consume 定义的队列有消息后
            // 就调用它对应的 callback
            $channel->wait();
        }
    }

}
