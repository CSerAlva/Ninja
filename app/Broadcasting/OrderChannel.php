<?php

namespace App\Broadcasting;

use App\Models\User;
use App\Order;

class OrderChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param \App\Models\User $user
     * @return array|bool
     */
    public function join(User $user, Order $order) //5.定义频道类 Leo
    {
        return $user->id === $order->user_id;
    }
}
