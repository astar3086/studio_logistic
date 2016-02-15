const accountNotFound = '-1';
const wrongPass = '-2';
const loginAccessDeny = '-3';
const Ok = 'true';
jQuery(document).ready(function(){
	jQuery('#submitForm').on('submit', function(event){
		//eMailValidation()
		jQuery.ajax({
			type: "POST",
			url: jQuery(this).attr("action"),
			cache: false,
			data: jQuery(this).serialize(),
			dataType: 'json',
			success: function(data)
			{
				if(data.code == true)
				{

					window.location.reload();
					//document.location.href = '/index/login';
					//bootbox.alert('Ok!)');
				}
				else
				{
					switch(data.code) {
						case accountNotFound:
							bootbox.alert('Такой eMail не найден в базе');
						break;
						case wrongPass:
							bootbox.alert('Неверный пароль');
						break;
						case loginAccessDeny:
							bootbox.alert('Системная ошибка! Вам запрещено заходить под этим аккаунтом');
						break;
					}

				}

			}
		});
		event.preventDefault();
		return false;
	});



});
