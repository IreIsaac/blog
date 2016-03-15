var Vue = require('vue');
Vue.use(require('vue-resource'));
require('sweetalert');

Vue.directive('delete-btn', require('./directives/delete.js'));

var vm = new Vue({
    el: 'body',

    ready: function() {
        var cookies = document.cookie.split(';');
        var token = '';

        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].split('=');
            if(cookie[0] == 'XSRF-TOKEN') {
                Vue.http.headers.common['X-XSRF-TOKEN'] = decodeURIComponent(cookie[1]);
            }
        }        
    },

    data: {},
});

(function() {
    if (window.location.pathname.includes('admin')) {
        var toggleSlidingNav = function() {
            var slidingPanel = document.querySelector('nav#sliding-nav');
            var overlay = document.querySelector('div.js-menu-screen.sliding-panel-fade-screen');
            slidingPanel.classList.toggle('is-visible');
            overlay.classList.toggle('is-visible');
        }

        var adminToggler = document.getElementById('admin-nav-toggler');
        var adminOverlay = document.getElementById('admin-overlay');
        adminToggler.addEventListener('click', toggleSlidingNav);
        adminOverlay.addEventListener('click', toggleSlidingNav);
    }
})();