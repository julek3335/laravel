import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//PWA
import './modules/pwa/installation';
import './modules/pwa/serviceWorker.js';

//jQuery Validation
import './modules/jquery-validation/jquery-validation.js';