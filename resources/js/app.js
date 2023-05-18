
import './bootstrap';

import $ from 'jquery';
import 'jquery-mask-plugin';

import './jQuery-mask';

import Alpine from 'alpinejs';

window.$ = window.jQuery = $;
window.$ = window.jQuery = require('jquery');
require('./bootstrap');

window.Alpine = Alpine;

Alpine.start();
