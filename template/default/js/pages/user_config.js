jQuery(document).ready(function(){
    baseurl = $( "#baseurl").val();

    $( "input[name=config]" ).click( function (e)
    {
        checked = $( this ).is(':checked') ? 1:0;
        var Obj = {  config: $( this ).data('id'),
                     param: checked
        };

        changeConfig( Obj );
    });

    function changeConfig( params ){

        jQuery.ajax({
            type: "POST",
            url: '/Portfolio/changeConfig/',
            data: params,
            cache: false,
            dataType: 'json',
            success: function ( data )
            {
                bootbox.alert('Has been changed!');

            },
            error: function (request, status, error)
            {
                console.log(status + ': ' + request.responseText);
            }
        });

    }

});