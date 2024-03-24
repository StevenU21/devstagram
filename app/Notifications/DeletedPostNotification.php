<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeletedPostNotification extends Notification
{
    use Queueable;
    public $post;
    public $user;
    public $follower;

    /**
     * Create a new notification instance.
     */
    public function __construct($post, $user, $follower)
    {
        $this->post = $post;
        $this->user = $user;
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toDatabase(object $notifiable): array
    {
        $imgurl = $this->post->user->url();

        $routeName = 'post.index'; // Nombre de la ruta
        $routeParams = ['user' => $this->follower->username]; // Parámetros de la ruta
        $url = route($routeName, $routeParams);

        return [
            'user_name' => $this->post->user->username,
            'message' => 'Eliminó el Post: ' . $this->post->text,
            'notification_created_at' => now()->diffForHumans(),
            'url' => $url,
            'profile_image' => $imgurl,
        ];
    }
}
