<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Broadcast;

class DeletedPostNotification extends Notification
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

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }

    public function toArray($notifiable): array
    {
        $imgurl = $this->post->user->image();

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

    public function broadcastOn()
    {
        return new PrivateChannel('notifications.' . $this->follower->id);
    }

    public function broadcastType()
    {
        return 'deleted-post';
    }
}
