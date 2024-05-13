import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import mask from '@alpinejs/mask';
import focus from '@alpinejs/focus';


window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.plugin(mask);
Alpine.plugin(focus);
Alpine.start();
