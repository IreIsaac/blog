var Vue = require('vue');
Vue.use(require('vue-resource'));
require('sweetalert');

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

    methods: {
        deleteModel: function(slug) {
            swal({
                title: "Are you sure?",   
                text: "You will not be able to recover this post!",
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes, delete it!",   
                closeOnConfirm: false 
            }, function(isConfirm) {
                if (isConfirm) {
                    Vue.http.post('/admin/post/' + slug, {_method: 'DELETE'}).then( function(response) {
                        
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);

                        swal({
                            title: "Deleted!",
                            text: "Post has been deleted.",
                            type: "success"
                        });
                    }).catch(function(error) {
                        swal({
                            title: "Uh Oh", 
                            text: "Something Went Wrong",
                            type: "warning"
                        });
                    });

                }
            });
        }
    }
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