// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'reverb',
//     key: import.meta.env.VITE_REVERB_APP_KEY,
//     wsHost: import.meta.env.VITE_REVERB_HOST,
//     wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
//     wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    //key: import.meta.env.VITE_PUSHER_APP_KEY,
    //cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    key: pusherKeyValue,
    cluster: pusherCluster || import.meta.env.VITE_PUSHER_APP_CLUSTER || "mt1",
    forceTLS: false
});

window.Echo.channel("order-placed").listen(
        "RTOrderPlaceNotificationEvent", (e) => {
            console.log(e);
    });
