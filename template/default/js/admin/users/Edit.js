jQuery(document).ready(function(){

    jQuery('#editForm').on('submit',function(event){

        jQuery.ajax({
            cache:false,
            data:jQuery(this).serialize(),
            type:jQuery(this).attr('method'),
            url:jQuery(this).attr('action'),
            dataType:'json',
            success: function(data)
            {
                switch(data.code)
                {
                    case -1:
                        bootbox.alert('System error. Some data not saving');
                        break;
                    case 0:
                        bootbox.alert('Успешно сохранен',function()
                        {
                            window.location.href = "/admin/Users/Index";

                        });
                        break;

                }

            },
            error:function(msg)
            {
                bootbox.alert('Network error');
            }
        });

        return false;
    });

});