<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatedPostNotification extends Notification
{
    use Queueable;
    public $post;
    public $follower;

    /**
     * Create a new notification instance.
     */
    public function __construct($post, $follower)
    {
        $this->post = $post;
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }


    public function toDatabase(object $notifiable): array
    {
        return $this->toArray($notifiable);
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }

    public function toArray(object $notifiable): array
    {
        $url = route('post.show', ['user' => $this->post->user->username, 'post' => $this->post->id]);
        $imgurl = $this->post->user->image();

        return [
            'user_name' => $this->post->user->username,
            'message' => 'Creó el Post: ' . $this->post->text,
            'notification_created_at' => now()->diffForHumans(),
            'url' => $url,
            'profile_image' => $imgurl,
        ];
    }

    public function broadcastOn()
    {
        return new PrivateChannel('notifications.' . $this->follower->id);
    }

    public function broadcastType()
    {
        return 'created-post';
    }
}
