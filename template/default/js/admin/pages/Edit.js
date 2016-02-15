var skObj1;
var skObj2;

jQuery(document).ready(function(){

    jQuery('#editForm').on('submit',function(event){
        event.preventDefault();
        var submitForm = jQuery('#editForm');

        var Obj =
        {
            title:submitForm.find('input[name=title]').val(),
            alias:submitForm.find('input[name=alias]').val(),
            page_type:submitForm.find('select[name=page_type]').val(),
            description:skObj1.getData(),
            main_text:skObj2.getData()
        };

        jQuery.ajax({
            cache:false,
            data:Obj,
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
                            window.location.href = "/admin/Pages/Index";

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

    skObj1 = CKEDITOR.replace('description', {
        uiColor: '#dddddd',
        toolbar: [
            ['Source', '-', 'Templates'] ,['Maximize', 'ShowBlocks'],
            ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
            ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'],
            ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'],
            ['BidiLtr', 'BidiRtl'],['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['Link', 'Unlink', 'Anchor'],
            ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar'],
            ['Styles', 'Format', 'Font', 'FontSize'],
            ['TextColor', 'BGColor']
        ]
    });

    skObj2 = CKEDITOR.replace('main_text', {
        uiColor: '#dddddd',
        toolbar: [
            ['Source', '-', 'Templates'] ,['Maximize', 'ShowBlocks'],
            ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
            ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'],
            ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'],
            ['BidiLtr', 'BidiRtl'],['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['Link', 'Unlink', 'Anchor'],
            ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar'],
            ['Styles', 'Format', 'Font', 'FontSize'],
            ['TextColor', 'BGColor']
        ]
    });

});