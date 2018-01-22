$( document ).ready(function() {
    $('.isAdmin').on('change', function(event){
        var userId = $(event.currentTarget).data('id');
        var isAdmin = !!$(event.currentTarget).is(':checked')? 1: 0;
        var data = {
            "isAdmin": isAdmin
        }
        $.ajax({
            method: 'POST', // Type of response and matches what we said in the route
            url: '/users/'+userId+'/makeAdmin', // This is the url we gave in the route
            data: data, // a JSON object to send back
            beforeSend: function(request) {
                request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function(response){ // What to do if we succeed

            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    })

    $('.isActive').on('change', function(event){
        var userId = $(event.currentTarget).data('id');
        var isActive = !!$(event.currentTarget).is(':checked')?1:0;
        console.log(userId, isActive);
        var data = {
            "isActive": isActive
        }
        $.ajax({
            method: 'POST', // Type of response and matches what we said in the route
            url: '/users/'+userId+'/makeActive', // This is the url we gave in the route
            data: data, // a JSON object to send back
            beforeSend: function(request) {
                request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function(response){ // What to do if we succeed

            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    });
});