import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';


import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import mask from '@alpinejs/mask';
import focus from '@alpinejs/focus';


import jQuery from 'jquery';
window.$ = jQuery;

window.Calendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
window.timeGridPlugin = timeGridPlugin;
window.listPlugin = listPlugin;
window.interactionPlugin = interactionPlugin;


window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.plugin(mask);
Alpine.plugin(focus);
Alpine.start();
