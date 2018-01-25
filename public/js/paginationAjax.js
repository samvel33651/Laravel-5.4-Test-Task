    $( document ).ready(function() {
        $( document ).on('click', 'th.sort a', function(event){
            event.preventDefault();
            var url = $(event.currentTarget).attr("href");
            $.ajax({
                method: 'POST',
                url: url,
                beforeSend: function(request) {
                request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
                success: function(response){
                    $('#itemsTable').html(response);

                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        });

        $( document ).on('click', 'ul.pagination a', function(event){
            event.preventDefault();
            var url = $(event.currentTarget).attr("href");
            $.ajax({
                method: 'POST',
                url: url,
                beforeSend: function(request) {
                request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
                success: function(response){
                    $('#itemsTable').html(response);

                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            })
        });
    });
