<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class UserFollowedNotification extends Notification
{
    use Queueable;
    protected $follower;
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($follower, $user)
    {
        $this->follower = $follower;
        $this->user = $user;
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

    public function toDatabase($notifiable): array
    {
        return $this->toArray($notifiable);
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }

    public function toArray($notifiable)
    {
        $routeName = 'post.index'; // Nombre de la ruta
        $routeParams = ['user' => $this->follower->username]; // Parámetros de la ruta
        $url = route($routeName, $routeParams);

        // foto de perfil de la persona que me esta siguiendo
        $imgurl = $this->follower->image();

        return [
            'user_name' => $this->follower->username,
            'message' => 'Te está siguiendo😇.',
            'notification_created_at' => now()->diffForHumans(),
            'url' => $url,
            'profile_image' => $imgurl,
        ];
    }

    public function broadcastOn()
    {
        return new PrivateChannel('notifications.' . $this->user->id);
    }

    public function broadcastType()
    {
        return 'user-followed';
    }
}
