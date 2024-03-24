<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentedPostNotification extends Notification
{
    use Queueable;

    public $post;
    public $commenter;

    public function __construct($post, $commenter)
    {
        $this->post = $post;
        $this->commenter = $commenter;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $url = route('post.show', ['user' => $this->post->user->username, 'post' => $this->post->id]);
        $imgurl = $this->commenter->url();

        return [
            'user_name' => $this->commenter->username,
            'message' => 'Ha comentado en tu post: ' . $this->post->text,
            'notification_created_at' => now()->diffForHumans(),
            'url' => $url,
            'profile_image' => $imgurl,
        ];
    }
}
