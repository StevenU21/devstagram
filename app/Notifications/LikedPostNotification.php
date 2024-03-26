<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
        return ['database']; // Esto enviará la notificación al canal de la base de datos
    }

    public function toDatabase(object $notifiable): array
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
}
