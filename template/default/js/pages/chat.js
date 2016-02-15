var map;
jQuery(document).ready(function(){

    function findNewMessages() {

        var Obj = {
            receiver_id: $( '#receiver_id' ).val()
        };

        showNewMessages( Obj );
    }

    // -- Find New Messages
    setInterval( findNewMessages, 3000 );

    $( ".show_full" ).click( function (e)
    {
        e.preventDefault();
        var Obj = {
            receiver_id: $( '#receiver_id' ).val()

        };

        showAllMessages( Obj );
    });

    $( "#formsub" ).click( function (e)
    {
        e.preventDefault();
        var Obj = {
            receiver_id: $( '#receiver_id' ).val(),
            message: $( '#message' ).val()
        };

        addMessage( Obj );
    });

    function addMessage( params ){

        jQuery.ajax({
            type: "POST",
            url: '/chat/addMessage/',
            data: params,
            cache: false,
            dataType: 'html',
            success: function ( data )
            {
                if ( data ){
                    $( '.messages' ).prepend( data );
                }

            },
            error: function (request, status, error)
            {
                console.log(status + ': ' + request.responseText);
            }
        });

    }

    function showAllMessages( params )
    {

        jQuery.ajax({
            type: "POST",
            url: '/chat/fullHistory/',
            data: params,
            cache: false,
            dataType: 'html',
            success: function ( data )
            {
                $( '.messages' ).append( data );
            },
            error: function (request, status, error)
            {
                console.log(status + ': ' + request.responseText);
            }
        });

    }

    function showNewMessages( params )
    {

        jQuery.ajax({
            type: "POST",
            url: '/chat/newHistory/',
            data: params,
            cache: false,
            dataType: 'html',
            success: function ( data )
            {
                if ( data ){
                    $( '.messages' ).prepend( data );
                }
            },
            error: function (request, status, error)
            {
                console.log(status + ': ' + request.responseText);
            }
        });

    }

});