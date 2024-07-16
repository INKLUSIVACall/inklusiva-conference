import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import {hideArea, showArea, toggleArea, animateArea} from './area-show-hide.js';

window.hideArea = hideArea;
window.showArea = showArea;
window.toggleArea = toggleArea;
window.animateArea = animateArea;

import {getViewport, determineViewportSize, betweenValues} from './viewport.js';

window.getViewport = getViewport;
window.determineViewportSize = determineViewportSize;
window.betweenValues = betweenValues;

import {hasSomeParentTheClass, checkCloseOverlays, toggleOverlay} from './overlay-control.js'
window.checkCloseOverlays = checkCloseOverlays;
window.toggleOverlay = toggleOverlay;
window.hasSomeParentTheClass = hasSomeParentTheClass;

import {toggleNavigation, checkCloseNavigation} from './navigation.js'
window.toggleNavigation = toggleNavigation;
window.checkCloseNavigation = checkCloseNavigation;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
