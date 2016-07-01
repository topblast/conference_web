
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
   $.backstretch([
                    "img/backgrounds/2.jpg",
	              "img/backgrounds/4.jpg"
	              //, "img/backgrounds/1.jpg"
	             ], {/*duration: 3000, fade: 750*/});
   


    $('body').data('backstretch').show(0);
    $('body').data('backstretch').pause();

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
    
    
});
