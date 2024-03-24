<?php

namespace App\Livewire\Notifications;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoadNotifications extends Component
{
    public $notifications;

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $user = Auth::user();
        $this->notifications = $user->Notifications;
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        if ($notification && !$notification->read_at) {
            $notification->markAsRead();
        }

        $this->loadNotifications(); // Actualizar después de marcar como leída
    }

    public function toggleAllNotifications()
    {
        $user = auth()->user();
    
        if ($user->unreadNotifications->isEmpty()) {
            $user->readNotifications->each(function ($notification) {
                $notification->markAsUnread();
            });
        } else {
            $user->unreadNotifications->markAsRead();
        }
    
        $this->loadNotifications(); // Actualizar después de marcar/desmarcar todas
    }

    public function deleteAllNotifications()
    {
        auth()->user()->notifications()->delete();
        $this->loadNotifications(); // Actualizar después de eliminar todas las notificaciones
    }

    public function redirectToNotification($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['url']);
        }
    }

    public function render()
    {
        return view('livewire.notifications.load-notifications');
    }
}
