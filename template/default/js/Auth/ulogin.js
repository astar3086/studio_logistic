/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 29.05.2014
 * Time: 17:26
 */
jQuery(document).ready(function(){
	jQuery('#uloginForm').on('submit', function(event){
		event.preventDefault();
		jQuery.ajax({
			type: "POST",
			url: jQuery(this).attr("action"),
			cache: false,
			data: jQuery(this).serialize(),
			dataType: 'json',
			success: function(data)
			{
				if(data.code)
				{
					switch (data.code)
					{
						case -1:
							bootbox.alert('Такой email не существует');
							break;
						case -2:
							bootbox.alert('Пароли не совпадают');
							break;
						case 'true':
							location.reload();
							break;
					}
				}
			},
			error: function ()
			{
				bootbox.alert('Ajax Login error');
			}
		});

		return false;
	});

	var timeout = 3000;
	var message ='rr';

	/*Msg.info(message, timeout);
	 Msg.warning(message, timeout);
	 Msg.error(message, timeout);
	 Msg.danger(message, timeout);*/
});
