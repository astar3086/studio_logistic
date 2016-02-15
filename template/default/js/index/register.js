jQuery(document).ready(function(){
	jQuery('#registerForm').on('submit', function(e){
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
					bootbox.alert('Вы успешно зарегестрированы в системе. Дождитесь подтверждения модератором.',function(){
						document.location.href = '/base2/index/login';
					});
				}
				else
				{
					switch(data.code) {
						case -3:
							bootbox.alert('Не все поля заполнены');
						break;
						case -1:
							bootbox.alert('Пароли не совпадают');
						break;
						case -2:
							bootbox.alert('Такой email уже зарегестрирован в системе');
						break;
					}

				}

			},
			error: function ()
			{

			}
		});
		//event.preventDefault();
		return false;
	});



});
function eMailValidation()
{
	var email = document.getElementById('email');
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	if (!filter.test(email.value)) {
		//alert('Please provide a valid email address');
		email.focus;
		return false;
	}
}