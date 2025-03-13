<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

//创建消息生产者（Publisher）创建一个服务类来发送消息到 RabbitMQ
class RabbitMQService
{
    protected $connection;
    protected $channel;

    protected $host = 'localhost'; // RabbitMQ 主机地址，可从.env读取
    protected $port = 5672; // RabbitMQ 端口，可从.env读取
    protected $user = 'guest'; // 用户名，可从.env读取
    protected $password = '597683'; // 密码，可从.env读取
    protected $vhost = 'pro.cn'; // 虚拟主机，可从.env读取
    protected $queue_name = 'my_queue'; // 队列名称
    protected $exchange_name = 'my_exchange'; // 交换器名称
    protected $exchange_type = 'direct'; // 交换器类型，例如 'direct', 'topic', 'fanout', 'headers' 等
    protected $routing_key = 'my_routing_key'; // 路由键

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password, $this->vhost);
        $this->channel = $this->connection->channel();
        $this->channel->exchange_declare($this->exchange_name, $this->exchange_type, false, false, false);
        $this->channel->queue_declare($this->queue_name, false, false, false, false);
        $this->channel->queue_bind($this->queue_name, $this->exchange_name, $this->routing_key);
    }

    public function publish($message)
    {
        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, $this->exchange_name);
        $this->channel->close();
        $this->connection->close();
    }
}
