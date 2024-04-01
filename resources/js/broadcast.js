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
        const messageText = `${notification.user_name} ${notification.message} (hace ${notification.notification_created_at})`;

        Toastify({
            text: messageText,
            duration: 3000,
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
                color: '#fff',
                borderRadius: '8px',
                padding: '12px',
                display: 'flex',
                alignItems: 'center',
            },
        }).showToast();
    });