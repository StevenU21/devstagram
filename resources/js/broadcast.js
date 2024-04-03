import 'bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css"

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Echo.private('notifications.' + user_id)
    .listen('.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', (notification) => {
        // console.log('Evento recibido:', notification);
        const messageText = `${notification.user_name} ${notification.message} (${notification.notification_created_at})`;

        Toastify({
            text: messageText,
            duration: -1,
            destination: notification.url,
            newWindow: true,
            close: true,
            gravity: 'top',
            position: 'right',
            avatar: notification.profile_image,
            onClick: () => {
                window.location.href = notification.url;
            },
            style: {
                display: 'flex',
                'text-align': 'left',
                'box-sizing': 'border-box',
                'color': '#fff',
                'border-radius': '1vw',
                'padding': '1vw',
                'width': '30rem',
            },
            className: 'toastify-notification',
        }).showToast();
    });

document.addEventListener('livewire:load', function () {
    window.livewire.emit('notificationReceived');
});
