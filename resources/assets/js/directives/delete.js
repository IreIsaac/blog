var Vue = require('vue');

module.exports = {
    params: ['route'],

    bind: function() {
        this.el.addEventListener('click', this.deleteModel.bind(this));
    },
    deleteModel: function() {
        var route = this.params.route;

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
                Vue.http.post(route, {_method: 'DELETE'}).then( function(response) {

                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);

                    swal({
                        title: "Deleted!",
                        text: "Model was deleted.",
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