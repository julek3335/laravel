import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//PWA
import './modules/pwa/serviceWorker.js';
import './modules/pwa/installation';

//jQuery Validation
import './modules/jquery-validation/jquery-validation.js';