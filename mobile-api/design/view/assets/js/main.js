jQuery(document).ready(function(){
    var first_data = true;

    $( "input[name=route]" ).change( function (e)
    {
        var Obj = {  controller: $( this ).data('controller'),
                    action: $( this ).data('action'),
                    mobile: 'view'
        };

        $( ".clean").click();
        Request( Obj, 'view' );
    });

    $( ".send" ).click( function (e)
    {

        checked = $( "input[name=route]:checked" );
        form = $( "#api_form" );

        var Obj = {  controller: checked.data('controller'),
                    action: checked.data('action'),
                    data: form.serialize(),
                    mobile: 'send'
        };

        Request( Obj, 'send' );
    });

    $( ".clean" ).click( function (e)
    {
        $(".response").html( '' );
    });

    function Request( params, mode ){

        jQuery.ajax({
            type: "POST",
            url: 'api.php',
            data: params,
            cache: false,
            dataType: 'html',
            success: function ( data )
            {

                if ( mode == 'view')
                {

                    $( ".request").html( data );

                } else {

                    var response = $(".response").html();
                    if ( first_data ) response = '';

                    first_data = false;
                    $(".response").html( response + data );

                }
            },
            error: function (request, status, error)
            {
                console.log(status + ': ' + request.responseText);
            }
        });

    }


});