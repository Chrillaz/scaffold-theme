import { runCookieNotice } from './modules/cookie-notice';

document.addEventListener( 'DOMContentLoaded', () => {

  runCookieNotice();
}, { once: true });