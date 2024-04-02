<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Broadcast;

class LikedPostNotification extends Notification
{
    use Queueable;
    public $post;
    public $liker;

    /**
     * Create a new notification instance.
     */
    public function __construct($post, $liker)
    {
        $this->post = $post;
        $this->liker = $liker;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // Esto enviará la notificación al canal de la base de datos y al broadcast.
    }

    public function toDatabase(object $notifiable): array
    {
        return $this->toArray($notifiable);
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }

    public function toArray($notifiable): array
    {
        $url = route('post.show', ['user' => $this->post->user->username, 'post' => $this->post->id]);
        $imgurl = $this->liker->image();

        return [
            'user_name' => $this->liker->username,
            'message' => 'Le dió like al post: ' . $this->post->text,
            'notification_created_at' => now()->diffForHumans(),
            'url' => $url,
            'profile_image' => $imgurl,
        ];
    }

    public function broadcastOn()
    {
        return new PrivateChannel('notifications.' . $this->post->user->id);
    }

    public function broadcastType()
    {
        return 'liked-post';
    }
}
