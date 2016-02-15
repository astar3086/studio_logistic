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

    function currentWindow( params )
    {
        $.each(params, function(idx, val) {
            current[ idx ] = val;
        });

    }

