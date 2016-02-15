var map;
jQuery(document).ready(function(){

    google.maps.event.addDomListener(window, 'load', function () {

        var myLatlng = new google.maps.LatLng(45.9899063,16.6168213);

        var mapOptions = {
            center: myLatlng,
            zoom:   2,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    });

});