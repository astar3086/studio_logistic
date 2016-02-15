jQuery(document).ready(function(){

    var counter       = 1;
    var main_fields   = ["complect_name","complect_descr",
        "complect_copyright","complect_image", "complect_cores_x",
            "complect_cores_y", "complect_camera", "complect_date"];

    jQuery('#update_complect').on('click',function( event ){
        if ( counter < 5 ){
            //addImage( null );
        }
    });

    jQuery('#img_path0').on('click',function( event ){
        jQuery(this).next().prop( "checked", true );
    });

    jQuery('#img_path1').on('click',function( event ){
        jQuery(this).next().prop( "checked", true );
    });

    jQuery('#img_path2').on('click',function( event ){
        jQuery(this).next().prop( "checked", true );
    });

    jQuery('#update_image').on('click',function( event ){

        var aValue = [];
        $('input[name="img_path[]"]').each(function() {
            aValue.push( $(this).val() );
        });

        jQuery.ajax({
            type: "POST",
            url: '/Gallery/getPhotoInfo/',
            data:
            {
                img_path: aValue,
                img_type: jQuery('input[name=img_type]:checked').val()
            },
            cache: false,
            dataType: 'json',
            success: function ( data ) {
                newBlock = addImage( data );
            },
            error: function ()
            {
                bootbox.alert('Ajax Server Error');
            }
        });
    });

    function addImage( data )
    {
        var cmpl_html = jQuery( "<div></div>" );
        var newBlock = jQuery("#complect_add").clone();

        id_new_block = 'complect_add' + counter;
        newBlock.attr( 'id', id_new_block );

        newBlock.css('display', 'block');
        newBlock.find('#load_image').attr('src', data['complect_image']);
        cmpl_html.append( newBlock );

        jQuery("#SubmitForm .fileupload_complect").before( cmpl_html.html() );
        jQuery( main_fields ).each(function ( ind, field ){

            if ( data == null ){
                jQuery('#' + id_new_block + ' #' + field).val( '' );
            } else {
                jQuery('#' + id_new_block + ' #' + field).val( data[ field ] );
            }

        });

        counter++;

        return newBlock;
    }

});

