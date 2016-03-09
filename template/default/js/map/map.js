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
                        var item_type = val2['service_type'];

                        map.addMarker({
                            lat: center_lat,
                            lng: center_lng,
                            marker_type: item_type,
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
                    var center_lat = val2['center_lat'];
                    var center_lng = val2['center_lng'];
                    var item_id    = val2['item_id'];
                    var item_type = val2['service_type'];
                    //console.log(item_type);

                    map.addMarker({
                        lat: center_lat,
                        lng: center_lng,
                        marker_type: item_type,
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

    function clearMapType( type )
    {
        map.removeMarkersCollection( type );
        return;
    }

    function clearMapFrom( item_id )
    {
        if ( collection[ item_id ] != undefined ){
            from = collection[ item_id ].from - 2;
            to   = collection[ item_id ].to + 1;

            console.log( from + "  " + to );
            map.removeMarkersFrom( from, to );
        }

        collection[ item_id ]=undefined;
        return;
    }

    $('.icon1').click(function()
    {
        var id = $(this).data("id");
        var tclass = '.block_service' + id;
        var show_markers =true;

        // Design Icon1
        design_icon1( tclass, id );
        if ( $(this).hasClass("image") ){
            show_markers = false;
        }

        //console.log(show_markers);

        // Airports
        if ( id == 2 )
        {
            clearMapType( id );
            if ( show_markers ) placeMarkers( id );

        } else if ( id == 1 ) { // See Ports

            //clearMapType( id );
            clearMapType( 10 );
            clearMapType( 11 );
            clearMapType( 13 );

            if ( show_markers )
            {

                placeMarkers( id );

                /*placeMarkers( 10 );
                placeMarkers( 11 );
                placeMarkers( 13 );*/
            }

            $( tclass ).toggle("slow");

        } else if ( id == 3 || id == 4 || id == 5
            || id == 6 || id == 7 || id == 8 || id == 9 ) {

            clearMap();

        } else {
            $( tclass ).toggle("slow");
        }

        $(this).toggleClass('image');
    });

});

$('.btns .hide_left_block').click(function() {
    $('.block').hide();
    $('.col-md-1 .row a').removeClass('image');
});

function design_icon1( tclass, id )
{

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
}

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
        },
      
        setCentreMap:function( ) {
            
        }
 
    });
  
     


    map.setOptions({
    });



}
 
  // var map = new google.maps.Map(document.getElementById('map'), {
  //     zoom: minZoomLevel,
  //     center: new google.maps.LatLng(38.50, -90.50),
  //     mapTypeId: google.maps.MapTypeId.ROADMAP
  //  });

 

   // Listen for the dragend event
 
