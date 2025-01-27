<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RTOrderPlaceNotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $message;
    public $orderId;
    public $date;


    /**
     * Create a new event instance.
     */
    //
    //public function __construct(Order $order)
    // {
    //     $this->message = '#'.$order->invoice_id.' a new order has been placed!';
    //     $this->orderId = $order->id;
    //     $this->date = date('h:i A | d-F-Y', strtotime($order->created_at));
    // }

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     * PrivateChannel: This is a special type of channel where only authorized
     * users can listen for the event. For example, this could be used when
     * you want to send events to a specific user or group of users who are
     * authenticated and authorized to listen to this channel.
     * Private channels typically require some kind of authorization,
     * usually checked via Laravel’s Auth system or through a custom authorization
     * callback.
     * For example, you might want to notify only the user who placed an
     * order or a particular group of users about an event.
     */
    // public function broadcastOn(): array
    // {
    //     return [
    //         new PrivateChannel('channel-name'),
    //     ];
    // }
/**
 * Channel: This represents a publicly accessible channel.
 * Anyone who is listening to the channel can receive the event, regardless of their
 * authentication status. It's typically used for general events that should be
 * broadcast to a wider audience (like notifying all users when a new order is placed,
 * for example).
 * Public channels are not restricted by any kind of authorization, so they are
 * often used when you want to notify all connected clients in a
 * particular context, like announcing a public event.
 *
 * Use public channels for events that apply to everyone
 * (e.g., sales, promotions, general product availability updates).
 */
    public function broadcastOn(): array
    {
        return [
            new Channel('order-placed'),
        ];
    }
}
