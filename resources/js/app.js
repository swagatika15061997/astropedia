import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
Echo.private(`App.Models.Astrologer.${astrologerId}`)
    .notification((notification) => {
        console.log(notification.message);
        // Display the notification to the astrologer
    });
