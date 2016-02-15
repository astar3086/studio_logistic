jQuery(document).ready(function(){
    var userAccess = jQuery('input[name=access]').val();
    var guestAlowed = jQuery('input[name=is_guest_allowed]').val();
    baseurl = $( "#baseurl").val();

    if ( userAccess < 1 && guestAlowed == 0 )
    {
        jQuery('#loginButton').click();
    }

    $( ".recovery" ).click( function (e)
    {
        $( ".email_hid").toggle();
    });

    $( ".recovery_send" ).click( function (e)
    {
        var Obj = {  email_send: $( "input[name=email_send]").val() };
        sendEmail( baseurl, $(this).data('action'), Obj );
    });

    $( ".i18n" ).click( function (e)
    {
        e.preventDefault();
        var Obj = {  i18n: $( this ).data('i18n') };
        changeLang( Obj );
    });


    function sendEmail( baseurl, url_path, params ){

        var submit_data =
        {
            'params': params
        };

        jQuery.ajax({
            type: "POST",
            url: url_path,
            data: submit_data,
            cache: false,
            dataType: 'json',
            success: function ( data )
            {
                $( ".attempt").html( data.code );

            },
            error: function (request, status, error)
            {
                console.log(status + ': ' + request.responseText);
            }
        });

    }

    function timeConverter(UNIX_timestamp){
        var a = new Date(UNIX_timestamp * 1000);
        var months = ['Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Ноября','Декабря'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        var time = date + ' ' + month + ' ' + year;
        return time;
    }

    function changeLang( params ){
        var pathname = window.location.pathname;

        jQuery.ajax({
            type: "POST",
            url: pathname,
            data: params,
            cache: false,
            dataType: 'json',
            success: function ( data )
            {
                location.reload();
            },
            error: function (request, status, error)
            {
                console.log(status + ': ' + request.responseText);
            }
        });

    }

});