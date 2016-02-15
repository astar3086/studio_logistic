var selector = '#viewList';
jQuery(document).ready(function(){

    var DTObj = jQuery(selector).dataTable({
        "bProcessing": true,
        "sAjaxSource": "GetJson/",
        "bDeferRender": true,
        "aoColumns":
            [
                { "mDataProp": "id", "sClass": "td-type"},
                { "mDataProp": "title" },
                { "mDataProp": "description" },
                { "mDataProp": "type" },
                { "mData": null, "sClass": "td-actions", "asSorting": {}, "sWidth": "10%" }
            ],
        "asStripeClasses": ['', ''],
        "fnServerParams": function(aoData)
        {

        },
        fnCreatedRow: function (nRow, aData, iDataIndex) {

            jQuery('.td-actions', nRow).html('<div class="btn-group">'+
                '<a href="Edit/'+aData.id+'/" class="btn btn-default" type="button"><i class="fa fa-pencil-square-o"></i></a>'+
                '<button data-id="'+aData.id+'" class="btn btn-default table-del-item" type="button"><i class="fa fa-trash-o"></i></button>'+
                //'<button class="btn btn-default" type="button">Right</button>' +
                '</div>');
        }
    });

    jQuery(selector).on('click','.table-del-item',function(e) {
        var submit_data = { 'id': jQuery(this).data('id') };
        var get_tr = jQuery(this).closest('tr').get(0);

        bootbox.confirm("Are you sure?", function(code) {
            if(true === code)
            {
                jQuery.ajax({
                    cache:false,
                    data: submit_data,
                    type: "POST",
                    url: "delete",
                    dataType:'json',
                    success: function(data)
                    {

                        switch(data.code)
                        {
                            case -1:
                                bootbox.alert('System error. Some data not saving');
                                break;
                            case 0:
                                bootbox.alert('Успешно Удален');
                                DTObj.fnDeleteRow(DTObj.fnGetPosition(get_tr));
                                break;

                        }
                    },
                    error:function(msg)
                    {
                        bootbox.alert('Network error');
                    }
                });
            }
        });
    });


});