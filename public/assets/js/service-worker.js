self.addEventListener('notificationclick', function (event) {
    event.notification.close();

    if (event.action === 'mark-as-read') {
        // Handle 'Mark as Read' action
        console.log('Marked as read');
    } else if (event.action === 'dismiss') {
        // Handle 'Dismiss' action
        console.log('Notification dismissed');
    } else {
        // Handle general notification click
        clients.openWindow('https://yourapp.com/events');
    }
}, false);
