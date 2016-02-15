var collection = {};
var last_index = 0;

var MarkerClusterer;
var current = {};
var markers;
var map;

$(document).ready(function() {

    $('#search').keypress(function (e) {
        var search = $(this).val();
        clearMap();

        if (e.which == 13) {
            e.preventDefault();

            jQuery.ajax({
                type: "POST",
                url: '/Places/getByName/',
                cache: false,
                data: {
                    search: search
                },
                dataType: 'json',
                success: function (data_array) {
                    markers = [];

                    $.each(data_array.data, function (idx2, val2) {
                        var center_lat = val2['center_lat'];
                        var center_lng = val2['center_lng'];
                        var item_id = val2['item_id'];

                        map.addMarker({
                            lat: center_lat,
                            lng: center_lng,
                            click: function (e) {
                                placeInfo( item_id );
                            },
                            infoWindow: {
                                content: '<p><div class="info' + item_id + '">Loading...</div></p>'
                            }
                        });

                    });


                }
            });

        }
    });

    // Left Services
    $(".serv_type").click(function(e){
        var get_id = $(this).data('id');
        var path = "/template/default/img/";

        if ( get_id == 10){
            active_pic = '3_icon_on.png';
            no_active_pic = '3_icon.png';
        }
        if ( get_id == 11){
            active_pic = '1_icon_on.png';
            no_active_pic = '1_icon.png';
        }
        if ( get_id == 13){
            active_pic = '2_icon_on.png';
            no_active_pic = '2_icon.png';
        }
 
        //clearMap();
        if ( collection[ get_id ] != undefined ){

            // No Active
            $(this).find("img").attr("src", path + no_active_pic);
            clearMapFrom( get_id );
        } else {

            // Active
            $(this).find("img").attr("src", path + active_pic);
            placeMarkers( get_id );
        }

    });

    function placeMarkers( get_id ){
        jQuery.ajax({
            type: "POST",
            url: '/Places/getByService/',
            async: false,
            cache: false,
            data: {
                id: get_id
            },
            dataType: 'json',
            success: function ( data_array ) {
                var length = Object.keys(data_array.data).length;
                last_index = map.lastMarkerIndex() + 1;

                collection[ get_id ] = {
                    'from': last_index,
                    'to': (last_index + length)
                };

                /*console.log(map);
                 return;*/

                $.each(data_array.data, function(idx2, val2) {
                    center_lat = val2['center_lat'];
                    center_lng = val2['center_lng'];
                    var item_id    = val2['item_id'];

                    map.addMarker({
                        lat: center_lat,
                        lng: center_lng,
                        click: function(e) {
                            placeInfo( item_id );
                        },
                        infoWindow: {
                            content: '<p><div class="info'+ item_id +'">Loading...</div></p>'
                        }
                    });

                });

            }
        });
    }

    function placeInfo( item_id )
    {
        jQuery.ajax({
            type: "POST",
            url: '/Places/getPlaceInfo/',
            cache: false,
            data: {
                id: item_id
            },
            dataType: 'json',
            success: function ( data_array ) {
                /*console.log(map);
                 return;*/

                $('.info' + item_id)
                    .html( data_array['content'] );

            }
        });

        return;
    }

    function clearMap()
    {
        last_index = 0;
        if (markerClusterer) {
            markerClusterer.clearMarkers();
        }

        return;
    }

    function clearMapFrom( item_id )
    {
        if ( collection[ item_id ] != undefined ){
            from = collection[ item_id ].from;
            to   = collection[ item_id ].to;

            console.log( from + "  " + to );
            map.removeMarkersFrom( from, to );
        }

        collection[item_id]=undefined;
        return;
    }

    $('.down_hide_icon').click(function() {
        $('.col-md-content').hide();
              
        $('.down_hide_icon').hide();
        $('.up_show_icon').show();
    });
    $('.up_show_icon').click(function() {
        $('.col-md-content').show();
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);   
        $('.up_show_icon').hide();
        $('.down_hide_icon').show();
    });

    $('.hide_left_block').click(function() {
        $('.col-md-1 .row:not(.btns)').hide();
        $('.col-md-1').css('height', 'auto');
        $('.hide_left_block').hide();
        $('.show_left_block').css('display', 'block');
    });
    $('.show_left_block').click(function() {
        $('.col-md-1 .row:not(.btns)').show()
        $('.col-md-1').css('height', '100%');
        $('.show_left_block').hide();
        $('.hide_left_block').show();
    });

   $('.show_sideblock').click(function() {
             $('.show_sideblock').removeClass('actived');
                // if($('#tab_icon1').hasClass( "minimized" )){
                //         $('#tab_icon1').addClass('actived');
                //     } else {
                //         $('#tab_icon1').removeClass('actived');
                //     }
                //     if($('#tab_icon2').hasClass( "minimized" )){
                //         $('#tab_icon2').addClass('actived');
                //     }else {
                //         $('#tab_icon2').removeClass('actived');
                //     }
                //     if($('#tab_icon3').hasClass( "minimized" )){
                //         $('#tab_icon3').addClass('actived');
                //     }else {
                //         $('#tab_icon3').removeClass('actived');
                //     }
                //     if($('#tab_icon4').hasClass( "minimized" )){
                //         $('#tab_icon4').addClass('actived');
                //     } 
                //     if($('#tab_icon5').hasClass( "minimized" )){
                //         $('#tab_icon5').addClass('actived');
                //     }else {
                //         $('#tab_icon5').removeClass('actived');
                //     }
                //     if($('#tab_icon6').hasClass( "minimized" )){
                //         $('#tab_icon6').addClass('actived');
                //     }else {
                //         $('#tab_icon6').removeClass('actived');
                //     }
                 var my_storage = localStorage.getItem("current_block");
        if(my_storage == "3_1" || my_storage == "3_2" || my_storage == "3_3" || my_storage == "3_4" || my_storage == "3_5"){
            $('#tab_icon3').addClass('actived');
        }     
              $('.col-md-content').show();
               $('.col-md-header').show();
                $('.section_header').show();
                 $('.section_header_7').show();
                 $('.section_header_6').show();

              $('.item').show();
              $('.show_icon').hide();
              $('.hide_icon').show();
              $('.back_icon').show();
             });


    $('.btn_block1').click(function() {
        $('.active').removeClass('active');
        $('.btn_block1').addClass('active');
          
        $('.tab_icons .btn_block1').addClass('actived');
        $('#block1').addClass('active');
    });
    $('.btn_block2').click(function() {
        console.log("click");
        $('.active').removeClass('active');
        $('.btn_block2').addClass('active');
         
          
        $('#tab_icon2').addClass('actived');
        $('#block2').addClass('active');
    });
    $('.btn_block3').click(function() {
        $('.active').removeClass('active');
        $('.btn_block3').addClass('active');
       
       
          
        $('.tab_icons .btn_block3').addClass('actived');
        $('#block3').addClass('active');
    });
    $('.btn_block4').click(function() {
        $('.active').removeClass('active');
        $('.btn_block4').addClass('active');
          
        $('.tab_icons .btn_block4').addClass('actived');
        $('#block4').addClass('active');
    });
    $('.btn_block5').click(function() {
        $('.active').removeClass('active');
        $('.btn_block5').addClass('active');
          
        $('.tab_icons .btn_block5').addClass('actived');
        $('#block5').addClass('active');
    });
    $('.btn_block6').click(function() {
        $('.active').removeClass('active');
        $('.btn_block6').addClass('active');
          
        $('.tab_icons .btn_block6').addClass('actived');
        $('#block6').addClass('active');
    });
     // sections
            $('.btn_container').click(function() {
               $('.active').removeClass('active');
               $('.btn_block3').addClass('active');
                $('#block3_1').addClass('active');
             });
            $('.btn_size_palet').click(function() {
               $('.active').removeClass('active');
               $('.btn_block3').addClass('active');
                $('#block3_2').addClass('active');
             });
            $('.btn_uld_type').click(function() {
               $('.active').removeClass('active');
               $('.btn_block3').addClass('active');
                $('#block3_3').addClass('active');
             });
            $('.btn_type_wagon').click(function() {
               $('.active').removeClass('active');
               $('.btn_block3').addClass('active');
                $('#block3_4').addClass('active');
             });
            $('.btn_incoterms').click(function() {
               $('.active').removeClass('active');
               $('.btn_block3').addClass('active');
                $('#block3_5').addClass('active');
             });

             $('.show_sideblock').click(function() {
                if($('#tab_icon1').hasClass( "minimized" )){
                        $('#tab_icon1').addClass('actived');
                    }  
                    if($('#tab_icon2').hasClass( "minimized" )){
                        $('#tab_icon2').addClass('actived');
                    } 
                    if($('#tab_icon3').hasClass( "minimized" )){
                        $('#tab_icon3').addClass('actived');
                    } 
                    if($('#tab_icon4').hasClass( "minimized" )){
                        $('#tab_icon4').addClass('actived');
                    } 
                    if($('#tab_icon5').hasClass( "minimized" )){
                        $('#tab_icon5').addClass('actived');
                    } 
                    if($('#tab_icon6').hasClass( "minimized" )){
                        $('#tab_icon6').addClass('actived');
                    } 
             });      
    $('.close_icon').click(function() {
        $('.active').removeClass('active');
        $('.actived').removeClass('actived');
        var id = $(this).data("block");
            var tab_icon = '#tab_icon'+ id;
            $(tab_icon).removeClass('minimized');
        localStorage.setItem("current_block", '');
    });
    
        // mobile hide menu after click
            $('#menu li a').click(function() {
              $('.navbar-collapse.collapse.in').removeClass('in');
              $('.navbar-collapse.collapse.in').attr("aria-expanded","false");
              $("html, body").animate({ scrollTop: $(document).height() }, 1000);
             });
     
 


    $('.icon1').click(function() {
        var id = $(this).data("id");
        var id_show = $(this).data("show");
        var tclass = '.block_service' + id;
        if($( window ).width() < 766) {
             var tclass_top = (20 + (id * 50)) + 'px';
         } else if($( window ).width() > 766 && $( window ).width() < 1200 ) {
             var tclass_top = (75 + (id * 50)) + 'px';
        } else if($( window ).width() > 1700 ) {
             var tclass_top = (55 + (id * 50)) + 'px';
         } else {
             var tclass_top = (45 + (id * 50)) + 'px';
         }
       

        $( tclass ).css('top', tclass_top);

        // Скрыть остальные блоки
        /*$( '.block' ).each(function(index){
            var current_id = $(this).data("id");
            if ( current_id != id ) $( this ).fadeOut(500);
        });*/

        // Airports
        if ( id == 2 )
        {
            clearMap();
            placeMarkers( id );
            return;

        } else if ( id == 1 ) {

            clearMap();
            placeMarkers( 10 );
            placeMarkers( 11 );
            //placeMarkers( 12 );
            placeMarkers( 13 );
            //placeMarkers( 14 );
            $( tclass ).toggle("slow");

        } else if ( id == 3 || id == 4 || id == 5
            || id == 6 || id == 7 || id == 8 || id == 9 ) {

            clearMap();

        } else {
            $( tclass ).toggle("slow");
        }

        $(this).toggleClass('image');
    });
    
    //========================================================================//
    // $('.show_sideblock').click(function() {
    //     var id = $(this).data("menu");
    //     var image =  $('img', this).attr('src');
    //     $(".tab_icons").append('<a href="#" data-block="'+ id +'" id="tab_icon'+ id +'" class="btn_block'+ id +' show_sideblock actived"><img src="' + image +'"></a>');
		
    // });   
    
    if (typeof(Storage) !== "undefined") {
        
    } else {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support Web Storage...";
    }
    // $('#menu li a').click(function() {
    //     var id = $(this).data("block");
    //     localStorage.setItem("current_block", id);
    //     var my_storage = localStorage.getItem("current_block");
    //     console.log(my_storage);
    // });
    $('.submenu').click(function() {
        var id = $(this).data("block");
        localStorage.setItem("current_block", id);
        var my_storage = localStorage.getItem("current_block");
        var image =  $('img', this).attr('src');
        $('.actived img').attr('src', image);
        console.log(my_storage);
    }); 
    $('#tab_icon3').click(function() {
        var my_storage = localStorage.getItem("current_block");
        if(my_storage !== "undefined"){
            var cur_block = '#block'+ my_storage;
            var par_block = cur_block.substring(0, cur_block.length-2);
            $(par_block).removeClass('active');
            $(cur_block).addClass('active');
            console.log('cur ' + cur_block);
            console.log('par ' + par_block);
        }
    }); 

    $('.back_icon ').click(function() {
         var my_storage = localStorage.getItem("current_block");
         var id = my_storage.substring(0, my_storage.length-2);
        localStorage.setItem("current_block", id);

        console.log("my_storage",id);
        var image2 = $('.navbar-nav li .active img').attr('src');
        $('.actived img').attr('src', image2);

        console.log("image2",image2);
         
    });
    $('#menu3 ').click(function() {
         var my_storage = localStorage.getItem("current_block");
         var id = my_storage.substring(0, my_storage.length-2);
        localStorage.setItem("current_block", id);

        console.log("my_storage",id);
        var image2 = $('.navbar-nav li .active img').attr('src');
        $('#tab_icon3.actived img').attr('src', image2);

        console.log("image2",image2);
         
    });

    //========================================================================//  


             
        $('.hide_sideblock').click(function() {
            var id = $(this).data("block");
            var tab_icon = '#tab_icon'+ id;
            $(tab_icon).addClass('minimized');

              $('.col-md-content').hide();
              $('.section_header').hide();
              $('.section_header_7').hide();
              $('.section_header_6').hide();
               $('.col-md-header').hide();
              
             
              $('.item').hide();
              $('.hide_icon').hide();
              $('.back_icon').hide();
              $('.show_icon').show();
             });

    function init() {
        // Basic options for a simple Google Map
        var mapOptions = {
            zoom: 2,
          
            center: new google.maps.LatLng(40.6700, -73.9400), // New York
            disableDefaultUI: true
        };

        var mapElement = document.getElementById('map_canvas');
        var map = new google.maps.Map(mapElement, mapOptions);

    }


});

function ajaxPaginate( page )
{

    sdata = {
        page: page
    };

    jQuery.ajax({
        type: "POST",
        url: current[ 'sendUrl' ],
        cache: false,
        data: sdata,
        dataType: 'json',
        success: function(data)
        {

            $('.active').removeClass('active');
            $('.ajax_content').html( data.content );
            $('#ajax_block').addClass('active');

        }
    });
}

function currentWindow( params )
{
    $.each(params, function(idx, val) {
        current[ idx ] = val;
    });

}

function initPaginate(){
    jQuery('.paginate').on('click', function(event) {
        event.preventDefault();
        var url = jQuery(this).attr('href');

        var param = getParameters( url );

        if (typeof param.page !== "undefined")
        {
            ajaxPaginate( param.page );
        } else {

            // First Page
            ajaxPaginate( 1 );
        }
    });
}

// URL Params
function getParameters( url ) {
    var searchString = url.substring(1),
        params = searchString.split("&"),
        hash = {};

    if (searchString == "") return {};
    for (var i = 0; i < params.length; i++) {
        var val = params[i].split("=");
        hash[unescape(val[0])] = unescape(val[1]);
    }

    return hash;
}

function initialize() {
    map = new GMaps({
        div: '#map_canvas',
        lat: -12.043333,
        lng: -77.028333,
         
         minZoom:2,
        zoom: 2,
        mapTypeControl: false,
        streetViewControl: false,
        panControl: false,
        zoomControl: true,
        scaleControl: true,
        scrollwheel: true,
        markerClusterer: function( map ) {
            markerClusterer = new MarkerClusterer( map );
            return markerClusterer;
        }

    });
    // var minZoomLevel = 3;

    //   var map = new google.maps.Map(document.getElementById('map_canvas'), {
    //       zoom: minZoomLevel,
          
    //       center: new google.maps.LatLng(0, 0),
    //       mapTypeControl: false,
    //           streetViewControl: false,
    //           panControl: false,
    //           zoomControl: true,
    //           scaleControl: true,
    //           scrollwheel: true,
    //       mapTypeId: google.maps.MapTypeId.ROADMAP
    //   });

    //   // Bounds for North America
    //   var strictBounds = new google.maps.LatLngBounds(
    //   new google.maps.LatLng(-35.124889, -31.708284),
    //   new google.maps.LatLng(71.135508, -173.282247));


    //   // Listen for the dragend event
    //   google.maps.event.addListener(map, 'dragend', function () {
    //       if (strictBounds.contains(map.getCenter())) return;

    //       // We're out of bounds - Move the map back within the bounds

    //       var c = map.getCenter(),
    //           x = c.lng(),
    //           y = c.lat(),
    //           maxX = strictBounds.getNorthEast().lng(),
    //           maxY = strictBounds.getNorthEast().lat(),
    //           minX = strictBounds.getSouthWest().lng(),
    //           minY = strictBounds.getSouthWest().lat();

    //       if (x < minX) x = minX;
    //       if (x > maxX) x = maxX;
    //       if (y < minY) y = minY;
    //       if (y > maxY) y = maxY;

    //       map.setCenter(new google.maps.LatLng(y, x));
    //   });

    //   // Limit the zoom level
    //   google.maps.event.addListener(map, 'zoom_changed', function () {
    //       if (map.getZoom() < minZoomLevel) map.setZoom(minZoomLevel);
    //   });

    map.setOptions({
       /* styles: [
            {
                "featureType": "water",
                "stylers": [{"visibility": "simplified"}, { "color": "#00BFFF" }]
            },{
                "featureType": "administrative",
                "stylers": [{"lightness": 30}]
            },{
                "featureType": "landscape",
                "stylers": [{"lightness": 60}]
            },{
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [
                    { "visibility": "off" }
                ]
            }
        ],
        backgroundColor: '#00BFFF'*/
          
    });



}

