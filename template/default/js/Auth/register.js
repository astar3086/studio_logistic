/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 19.03.14
 * Time: 17:43
 */
jQuery(document).ready(function(){

    $('#registerButton').on('click', function(event) {
        bootbox
            .dialog({
                title: 'Registration',
                message: $('#registerForm'),
                show: false // We will show it manually later
            })
            .on('shown.bs.modal', function() {
                $('#registerForm')
                    .show()                                 // Show the login form
                    .bootstrapValidator('resetForm', true); // Reset form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the login form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#registerForm').hide().appendTo('body');
            })
            .modal('show');
    });

	jQuery('#registerForm').on('submit', function(event){
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
					location.reload();
				}
				else
				{
					switch(data.code) {
						case -3:
							bootbox.alert('Не заполнены обязательные поля!');
						break;
						case -4:
							bootbox.alert('Такой Email уже существует');
						break;
						case -1:
                            bootbox.alert('Пароли не совпадают!');
                        break;
						case -2:
							bootbox.alert('Системная ошибка!');
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