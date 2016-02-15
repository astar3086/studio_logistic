/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Create
 * Date: 18.09.13
 * Time: 17:56
 * Fixed
 * Date: 14.05.2014
 * Time: 12:30
 */
var bmodal;
bmodal = {

	callback: {
		// Location of the server-side upload script
		OnSubmitData:function(data)
		{
			bootbox.alert(data.content, function() {
				bootbox.hideAll();
				jQuery('#'+modal.modal_prefix+'Modal').modal('hide');
				modal.DataTableObject.fnClearTable();
				modal.DataTableObject.fnReloadAjax();
			});
		},
		onOpenWindow: function(DataContent,user_id) {alert('Under Construction onOpenWindow');}

	},
	modal_prefix: 'temp',
	LoadBar: null,

	OpenModal: function(obj)
	{
		bmodal.LoadBarInit('open');

		jQuery('.modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button><h3>' + obj.title + '</h3>');  // Modal title (header)

		var htmlData = '';
		if(typeof obj.content!= 'string')
		{
			if(obj.content.url == undefined)
			{
				alert('Url is undefined');
				return false;
			}
			if(obj.content.data == undefined)
			{
				alert('data is undefined');
				return false;
			}
			jQuery.ajax({
				type: "POST",
				url: obj.content.url,
				cache: false,
				data: obj.content.data,
				dataType: 'json',
				complete: function(data)
				{
					//
				},
				success: function(data)
				{
					htmlData = data.content;
					bmodal.callback.onOpenWindow.call({}, data);
				},
				error: function ()
				{
					bmodal.LoadBarInit('close');
					bootbox.alert('Ошибка Ajax запроса', function () {
						//jQuery('.ModalSMBButt').removeAttr("disabled");

					});
				}
			});
		}
		else
		{
			htmlData = obj.content;
			bmodal.callback.onOpenWindow.call({});
		}
		//Hide loader animation
		bmodal.LoadBarInit('close');
		jQuery('#' + bmodal.modal_prefix + 'Modal').modal();// Show modal
		jQuery('.modal-body').html(htmlData).css('width', obj.width).css('height', obj.height);// Modal content (body)
	},


	Submit_data_form: function(id) {
		modal.LoadBarInit('open');
		jQuery('.ModalSMBButt').attr("disabled", "disabled");
		jQuery('#'+modal.modal_prefix+'Modal').modal('hide');
		modal.callback.onSubmitWindow.call();
		var data = jQuery('#' + modal.form_id).serializeArray();
		/* Доавление ID в стек */
		if (id != null) {
			data.push({ name: 'id', value: id });
		}

		data = jQuery.param(data);

		jQuery('#' + modal.form_id).on('submit',
			jQuery.ajax({
				type: "POST",
				url: modal.base_url + jQuery('#' + modal.form_id).attr("action"),
				data: data,
				dataType: "json",
				complete: function(data)
				{
					if(typeof phpdebugbar!= 'undefined')
					{
						jQuery(document).ajaxComplete(function(e, xhr, settings){
							phpdebugbar.ajaxHandler.handle(xhr);
						})
					}

				},
				success: function(data){

					if(data.status == 'success')
					{
						modal.callback.OnSubmitData.call({},data);
					}
					else
					{

						bootbox.alert(data.content, function () {
							jQuery('.ModalSMBButt').removeAttr("disabled");
							jQuery('#'+modal.modal_prefix+'Modal').modal();

						});
					}
				},
				/*Если ошибка аякс запроса на уровне http*/
				error: function(){
					modal.LoadBarInit();
					bootbox.alert('Ошибка Ajax запроса', function () {
						jQuery('#'+modal.modal_prefix+'Modal').modal();
						jQuery('.ModalSMBButt').removeAttr("disabled");

					});
				}
			})
		);
	},


	init_trigger: function (btn_container, btn_class, Lable,OpenModalObject)
	{

		jQuery(btn_container).html('<button type="button" id="' + this.modal_prefix + 'Btn" class="btn '+btn_class+'">' + Lable + '</button>');
		jQuery('body').append(
		'<div id="' + this.modal_prefix + 'Modal" class="modal fade"tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
		'<div class="modal-dialog">' +
			'<div class="modal-content">' +
				'<div class="modal-header"></div>' +
				'<div class="modal-body"></div>' +
				'<div class="modal-footer"></div>' +
			'</div>' +
		'</div>' +

		'</div>');

		jQuery('#' + this.modal_prefix + 'Btn').on('click', function () {
			bmodal.OpenModal(OpenModalObject);
		});

		jQuery(document).keyup(function (e) {
			if (e.keyCode == 27) {
				jQuery(modal.modal_prefix + 'Modal').modal('hide');
			}
		});

	},

	LoadBarInit: function(action)
	{
		if (!jQuery('#LoadBar').length)
		{
			jQuery('body').append('<div id="LoadBar" style="position: fixed;top: 0;right: 0;bottom: 0;left: 0;background: rgba(0,0,0,0.8);z-index: 99999;"></div>');

			jQuery('#LoadBar').append('<div class="center_alt"><h4 class="text-info"><i class="icon-spinner icon-spin orange bigger-125"></i> Loading....</h4></div>');
		}

		if(action == 'open')
		{
				jQuery('#LoadBar').css('display','inline');
		}
		else
		{
			jQuery('#LoadBar').css('display','none');
		}


		/*--------------------------------------*/


	}
};