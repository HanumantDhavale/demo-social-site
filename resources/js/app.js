require('./bootstrap');

window.Vue = require('vue');

import nProgress from "nprogress";

nProgress.configure({
    showSpinner: true,
    trickleRate: 0.02,
    trickleSpeed: 800,
    easing: 'ease',
    speed: 500,
    minimum: 0.1
});

window.nProgress = nProgress;

import toastr from 'toastr';

window.toastr = toastr;
