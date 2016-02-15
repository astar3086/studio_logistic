jQuery(document).ready(function(){

    // Login button click handler
    $('#loginButton').on('click', function(event) {
        bootbox
            .dialog({
                title: 'Login',
                message: $('#loginForm'),
                show: false // We will show it manually later
            })
            .on('shown.bs.modal', function() {
                $('#loginForm')
                    .show()                                 // Show the login form
                    .bootstrapValidator('resetForm', true); // Reset form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the login form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#loginForm').hide().appendTo('body');
            })
            .modal('show');
    });

	jQuery('#loginForm').on('submit', function(event){
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
					switch (data.code) {
						case -1:
							bootbox.alert('Email not found!');
						break;
						case -2:
							bootbox.alert('Wrong Password!');
						break;
						case -3:
							bootbox.alert('You have no permissions!');
						break;
						case true:
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

	jQuery('#ExitBtn').on('click', function(event){
		jQuery.ajax({
			type: "POST",
			url: jQuery(this).attr("data-url"),
			cache: false,
			dataType: 'json',
			success: function(data)
			{
				if(data.code == 1)
				{
					location.reload();
				}
				else
				{
					bootbox.alert('Logout error');
				}
			},
			error: function ()
			{
				bootbox.alert('Ajax Login error');
			}
		});
	});

});
