const CACHE_NAME = 'asc-disso-v1.0.0';
const urlsToCache = [
    '/',
    '/offline',
    '/images/logo.png',
    '/css/app.css',
    '/js/app.js'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Cache ouvert');
                return cache.addAll(urlsToCache).catch(error => {
                    console.error('Erreur de cache:', error);
                });
            })
            .then(() => self.skipWaiting())
    );
});

self.addEventListener('activate', event => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        Promise.all([
            caches.keys().then(cacheNames => {
                return Promise.all(
                    cacheNames.map(cacheName => {
                        if (cacheWhitelist.indexOf(cacheName) === -1) {
                            return caches.delete(cacheName);
                        }
                    })
                );
            }),
            self.clients.claim()
        ])
    );
});

self.addEventListener('fetch', event => {
    if (event.request.url.includes('/api/') || 
        event.request.url.includes('/admin/') ||
        event.request.method !== 'GET') {
        return;
    }

    event.respondWith(
        fetch(event.request)
            .then(response => {
                if (!response || response.status !== 200 || response.type !== 'basic') {
                    return response;
                }
                const responseToCache = response.clone();
                caches.open(CACHE_NAME).then(cache => cache.put(event.request, responseToCache));
                return response;
            })
            .catch(() => {
                return caches.match(event.request).then(response => {
                    if (response) return response;
                    if (event.request.headers.get('accept').includes('text/html')) {
                        return caches.match('/offline');
                    }
                    return new Response('', { status: 408, statusText: 'Request timeout' });
                });
            })
    );
});

self.addEventListener('push', event => {
    const options = {
        body: event.data ? event.data.text() : 'Nouvelle notification',
        icon: '/images/logo.png',
        badge: '/images/logo.png',
        vibrate: [100, 50, 100],
        data: { dateOfArrival: Date.now(), primaryKey: 1 },
        actions: [
            { action: 'explore', title: 'Voir' },
            { action: 'close', title: 'Fermer' }
        ]
    };
    event.waitUntil(self.registration.showNotification('ASC Disso', options));
});

self.addEventListener('notificationclick', event => {
    event.notification.close();
    if (event.action === 'explore') clients.openWindow('/');
});