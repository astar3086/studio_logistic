var collection = {};
var last_index = 0;

var MarkerClusterer;
var current = {};
var markers;
var map;

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
        $('.col-md-1 .row:not(.btns)').show();
        $('.col-md-1').css('height', '100%');
        $('.show_left_block').hide();
        $('.hide_left_block').show();
    });

   $('.show_sideblock').click(function() {
        $('.show_sideblock').removeClass('actived');        
        var my_storage = localStorage.getItem("current_block");
        console.log(my_storage);
        if(my_storage === "3_1" || my_storage === "3_2" || my_storage === "3_3" || my_storage === "3_4" || my_storage === "3_5"){
            $('#tab_icon3').addClass('actived');
        }    
            var id = $(this).data("block");
            var btn_block = '.btn_block'+ id;
            var tab_icon = '#tab_icon'+ id;
            var block = '#block'+ id;
            $('.active').removeClass('active');
            $(btn_block).addClass('active');
            $(tab_icon).addClass('actived');
            $(block).addClass('active');

           $('.col-md-content').animate({
                right: "0px"
            }, 200);

            $('.item').show();
            $('.show_icon').hide();
            $('.hide_icon').show();
            $('.back_icon').show();
   });


    
     // sections
           $('.btn_block3_1').click(function() {
               $('.active').removeClass('active');
               $('.btn_block3').addClass('active');
                $('#block3_1').addClass('active');
             });
            $('.btn_block3_2').click(function() {
               $('.active').removeClass('active');
               $('.btn_block3').addClass('active');
                $('#block3_2').addClass('active');
             });
            $('.btn_block3_3').click(function() {
               $('.active').removeClass('active');
               $('.btn_block3').addClass('active');
                $('#block3_3').addClass('active');
             });
            $('.btn_block3_4').click(function() {
               $('.active').removeClass('active');
               $('.btn_block3').addClass('active');
                $('#block3_4').addClass('active');
             });
            $('.btn_block3_5').click(function() {
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
        var id = $(this).data("block");
        console.log(id);
        var tab_icon = '#tab_icon'+ id;
        $(tab_icon).removeClass('minimized').removeClass('actived');
        if(id == "3_1" || id == "3_2" || id == "3_3" || id == "3_4" || id == "3_5"){
            localStorage.setItem("current_block", '');
        }   
         
    });
    
    // mobile hide menu after click
    $('#menu li a').click(function() {
      $('.navbar-collapse.collapse.in').removeClass('in');
      $('.navbar-collapse.collapse.in').attr("aria-expanded","false");
      $("html, body").animate({ scrollTop: $(document).height() }, 1000);
     });
     
    //========================================================================//
 
    
    if (typeof(Storage) == "undefined") {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support Web Storage...";
    }

 
    $('.submenu').click(function() {
        var id = $(this).data("block");
         // var tab_icon = '#tab_icon'+ id;
        localStorage.setItem("current_block", id);
        var my_storage = localStorage.getItem("current_block");
        var image =  $('img', this).attr('src');
        $('#tab_icon3 img').attr('src', image);
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
         var cur_block = '#block'+ id;
         $(cur_block).addClass('active');
         $('.btn_block3').addClass('active');
        console.log("my_storage",id);
        var image2 = $('.navbar-nav li .active img').attr('src');
        $('#tab_icon3 img').attr('src', image2);

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
        $(tab_icon).addClass('minimized').removeClass('active');

          $('.col-md-content').animate({
                   right: "-500px"
                  }, 200);
           $('.col-md-8.col-md-content').animate({
                    right: "-1000px"
                  }, 200);
           $('.col-md-7.col-md-content').animate({
                    right: "-850px"
                  }, 200);
           $('.col-md-6.col-md-content').animate({
                    right: "-750px"
                  }, 200);

          $('.item').hide();
          $('.hide_icon').hide();
          $('.back_icon').hide();
          $('.show_icon').show();
    });

    function currentWindow( params )
    {
        $.each(params, function(idx, val) {
            current[ idx ] = val;
        });

    }

