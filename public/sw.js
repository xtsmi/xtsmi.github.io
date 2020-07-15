var CACHE_NAME = 'tsmi-v1';

var urlsToCache = ['/', '/list', '/js/app.js'];

self.addEventListener('install', function(event) {
    event.waitUntil(
        caches
            .open(CACHE_NAME)
            .then(function(cache) {
                return cache.addAll(urlsToCache);
            })
            .catch(function(e) {
                console.error('Opened cache error', e);
            }),
    );
});

// TODO:: Замутить очистку
// self.addEventListener('activate', function(event) {
//     event.waitUntil(
//         caches.keys().then(function(cacheNames) {
//             return Promise.all(
//                 cacheNames.map(function(cacheName) {
//                     return caches.delete(cacheName);
//                 }),
//             );
//         }),
//     );
// });

self.addEventListener('fetch', function(event) {
    if (event.request.method !== 'GET') {
        return event.respondWith(fetch(event.request.clone()));
    }

    event.respondWith(
        caches.match(event.request).then(function(resp) {
            return (
                resp ||
                fetch(event.request).then(function(response) {
                    return caches.open(CACHE_NAME).then(function(cache) {
                        cache.put(event.request, response.clone());
                        return response;
                    });
                })
            );
        }),
    );
});
