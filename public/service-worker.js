const CACHE_NAME = 'notes-pwa-v2';

const urlsToCache = [
    '/',
    '/dashboard',
    '/offline'
];

self.addEventListener('install', event => {

    event.waitUntil(

        caches.open(CACHE_NAME)
            .then(cache => {

                return cache.addAll(urlsToCache);

            })

    );

});

self.addEventListener('fetch', event => {

    event.respondWith(

        fetch(event.request)

            .catch(() => {

                return caches.match(event.request)
                    .then(response => {

                        return response ||
                               caches.match('/offline');

                    });

            })

    );

});