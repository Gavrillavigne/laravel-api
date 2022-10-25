<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Review;


class AddReviewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Review  */
    public $review;

    public $userId;

    /**
     * @param Review $review
     * @param $userId
     */
    public function __construct(Review $review, $userId = null)
    {
        $this->review = $review;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if (!empty($this->userId)) {
            // Отправка push в приватный канал пользователю
            return new PrivateChannel('user.' . $this->userId);
        }

        // Отправка push всем пользователям
        return new Channel('for-all-users');
    }
}
