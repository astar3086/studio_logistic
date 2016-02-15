// Функции раздела Карта "Каталог"
jQuery(document).ready(function(){

	jQuery('.catalog_transport').on('click', function(event){
		event.preventDefault();

		sdata = {
			page: 1
		};

		if ( current
				&& current.window != 'catalog_transport' )
		{
			// Load Pagination
			sdata.is_pagination = true;
		}

		jQuery.ajax({
			type: "POST",
			url: '/Catalog/transportCatalog/',
			cache: false,
			data: sdata,
			dataType: 'json',
			success: function(data)
			{

				$('.active').removeClass('active');
				$('.ajax_content').html( data.content );
				$('#ajax_block').addClass('active');

				if ( current
						&& current.window != 'catalog_transport' )
				{
					$('.pages').html( data.pagination );
					currentWindow({'window': 'catalog_transport',
					'sendUrl': '/Catalog/transportCatalog/' });

					// Init Events
					initPaginate();
				}

			}
		});

		return false;
	});

});
