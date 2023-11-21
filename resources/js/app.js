
import './bootstrap';

import $ from 'jquery';
import 'jquery-mask-plugin';

import './jQuery-mask';

import Alpine from 'alpinejs';

import * as docx from "docx-preview";


window.$ = window.jQuery = $;
window.$ = window.jQuery = require('jquery');
require('./bootstrap');

window.Alpine = Alpine;

Alpine.start();
