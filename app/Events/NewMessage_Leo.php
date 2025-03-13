<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage_Leo implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $roomId;
    public $msg;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($roomId, $msg)
    {
        $this->user = auth()->user();
        $this->roomId = $roomId;
        $this->msg = $msg;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('chat.' . $this->roomId);
    }

    //1.设置广播名称 默认是事件的类名 Leo
    public function broadcastAs()
    {
        return 'server.created';
    }

    //2.增加广播数据 (本来是在构造函数中传递过来的), 默认只含 public 属性 Leo
    public function broadcastWith()
    {
        return ['id' => $this->user->id];
    }
}
