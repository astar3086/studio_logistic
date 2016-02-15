jQuery(document).ready(function(){

    $( ".toggle" ).click( function (e)
    {
        e.preventDefault();

        $( ".attempt").html( '' );
        $( ".complaint_variant").toggle();
    });

    $( ".remove" ).click( function (e)
    {
        e.preventDefault();

        bootbox.dialog({
            message: '<form><div class="form-group"><label>Remove All<input id="IsRemoveAll" name="IsRemoveAll" type="checkbox" /></label></div></form>',
            title: "Remove All Sights, Photos And Videos?",
            buttons: {
                success: {
                    label: "Save",
                    className: "btn-success",
                    callback: function() {

                        set_checked = 0;
                        if ( jQuery('#IsRemoveAll').prop("checked") == true){
                            set_checked = 1;
                        }

                        jQuery.ajax({
                            cache:false,
                            data:{
                                value: set_checked
                            },
                            type:'POST',
                            url:'delete',
                            dataType:'json',
                            success: function( data )
                            {
                                if ( data.code == 1 ){
                                    location.reload();
                                }
                            }
                        });
                    }
                }
            }
        });
    });


    $( ".toggle_more" ).click( function (e)
    {
        e.preventDefault();

        $( ".attempt").html( '' );
        $( ".complaint").toggle();
    });

    $( ".custom_complaint" ).click( function (e)
    {

        sparent = $(this).parent();
        reason      = sparent.find("#complaint").val();
        user_id     = sparent.find("input[name=user_id]").val();
        target_id   = sparent.find("input[name=target_id]").val();
        target_type = sparent.find("input[name=target_type]").val();
        toggle      = sparent.find("input[name=toggle]").val();
        complaint   = 'custom';

        var Obj = {
            complaint: complaint,
            reason: reason,
            user_id: user_id,
            target_id: target_id,
            target_type: target_type
        };

        sendReason( Obj, toggle );
    });


    $( ".reason_sub" ).click( function (e)
    {

        reason     = $("textarea[name=reason]").val();
        user_id    = $("input[name=user_id]").val();
        profile_id = $("input[name=profile_id]").val();
        complaint  = 'reason';

        var Obj = {
            complaint: complaint,
            reason: reason,
            user_id: user_id,
            profile_id: profile_id
        };

        sendReason( Obj );
    });

    function sendReason( params ){
        jQuery.ajax({
            type: "POST",
            url: '/Portfolio/complaint',
            data: params,
            cache: false,
            dataType: 'json',
            success: function ( data )
            {
                $( ".attempt").html( data.code );
                $( ".complaint").toggle();
            },
            error: function (request, status, error)
            {
                console.log(status + ': ' + request.responseText);
            }
        });

    }
});