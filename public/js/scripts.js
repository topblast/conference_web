jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
//   $.backstretch([
//                    "img/backgrounds/2.jpg",
//	              "img/backgrounds/4.jpg"
//	              //, "img/backgrounds/1.jpg"
//	             ], {/*duration: 3000, fade: 750*/});
//   
//
//    var path = location.href.split("/");
//    if ( path.length > 3 && path[4] == "main" ) 
//    {
//        console.log("if reached");
//        $('body').data('backstretch').show(1);
//    
//    } 
//    
//    else
//    {
//        console.log("else reached " + path[4]);
//         $('body').data('backstretch').show(0);
//    }
//    $('body').data('backstretch').pause();
    
    

	
    /*
        Fullscreen background
    */
    $('#myCarousel').carousel({
  interval:200
  });
    
   // $.backstretch([
   //                  "img/backgrounds/2.jpg",
	  //             "img/backgrounds/4.jpg"
	  //             //, "img/backgrounds/1.jpg"
	  //            ], {/*duration: 3000, fade: 750*/});
   


   //  $('body').data('backstretch').show(0);
   //  $('body').data('backstretch').pause();

    /*
        Form validation
    */
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.login-form').on('submit', function(e) {
    	
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });


// .modal-backdrop classes

$(".modal-transparent").on('show.bs.modal', function () {
  setTimeout( function() {
    $(".modal-backdrop").addClass("modal-backdrop-transparent");
  }, 0);
});
$(".modal-transparent").on('hidden.bs.modal', function () {
  $(".modal-backdrop").addClass("modal-backdrop-transparent");
});

$(".modal-fullscreen").on('show.bs.modal', function () {
  setTimeout( function() {
    $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
  }, 0);
});
$(".modal-fullscreen").on('hidden.bs.modal', function () {
  $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
});


   
    
});
