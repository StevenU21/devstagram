<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUnfollowNotification extends Notification
{
    use Queueable;
    protected $follower;

    /**
     * Create a new notification instance.
     */
    public function __construct($follower)
    {
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

    public function toDatabase($notifiable)
    {
        $routeName = 'post.index'; // Nombre de la ruta
        $routeParams = ['user' => $this->follower->username]; // Parámetros de la ruta
        $url = route($routeName, $routeParams);

        // foto de perfil de la persona que me esta siguiendo
        $imgurl = $this->follower->image();

        return [
            'user_name' => $this->follower->username,
            'message' => 'Ha dejado de seguirte😒.',
            'notification_created_at' => now()->diffForHumans(),
            'url' => $url,
            'profile_image' => $imgurl,
        ];
    }
}
