/** T0开始
 * Axios 是一个基于 promise 的网络请求库，可以用于 浏览器 和 node.js
 * */
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/** T0结束 */

/** Alex */
import 'bootstrap';

/** laravel-echo 默认
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
import Echo from 'laravel-echo';

/**
 * laravel-echo Alex
 * */
import {io} from 'socket.io-client';
window.io=io;

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

/*
公有频道 zy messages.blade.php, Leo countryside.blade.php
*/
// window.Echo.channel('countryside')  //Leo
//     .listen('Free_Leo', (e) => {
//         console.log(e);
// });

/*
私有频道 Leo 设置客户端监听广播 Leo 私有频道
*/
window.Echo.private('three_good_Leo')
    .listen('Prize_Leo', (e) => {
        console.log(e);
    });
