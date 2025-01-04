import './bootstrap';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';


window.Alpine = Alpine;
Alpine.plugin(mask);
Alpine.plugin(focus);
Alpine.plugin(collapse)

Alpine.start();


