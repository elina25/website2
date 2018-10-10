// Tooltip from CSS Globe written by Alen Grakalic (http://cssglobe.com)
this.tooltip = function(){xOffset = -10;yOffset = 10;jQuery.noConflict();jQuery(".tooltip").hover(function(e){this.t = this.title;this.title = "";jQuery("body").append("<p class='itooltip'>"+ this.t +"</p>");jQuery(".itooltip").css("top",(e.pageY - xOffset) + "px").css("left",(e.pageX + yOffset) + "px").fadeIn(500);},function(){this.title = this.t; jQuery(".itooltip").remove();});jQuery("a.tooltip").mousemove(function(e){jQuery(".itooltip").css("top",(e.pageY - xOffset) + "px").css("left",(e.pageX + yOffset) + "px");});};
//END TOOLTIP

jQuery.noConflict(); jQuery(document).ready(function(){

	tooltip();
	
	//VARIABLES
	var mainBox = jQuery('#main'),
    	pageBox = jQuery(".pageContent"),
    	loading = jQuery('#loading'),
    	//iPad,iPhone,iPod...
    	deviceAgent = navigator.userAgent.toLowerCase(),
    	iPadiPhone = deviceAgent.match(/(iphone|ipod|ipad)/);

	var opts = {
  		lines: 12, // The number of lines to draw
  		length: 8, // The length of each line
  		width: 3, // The line thickness
  		radius: 16, // The radius of the inner circle
  		corners: 1, // Corner roundness (0..1)
  		rotate: 0, // The rotation offset
  		direction: 1, // 1: clockwise, -1: counterclockwise
  		color: '#fff', // #rgb or #rrggbb or array of colors
  		speed: 1, // Rounds per second
  		trail: 100, // Afterglow percentage
  		shadow: false, // Whether to render a shadow
  		hwaccel: false, // Whether to use hardware acceleration
  		className: 'spinner', // The CSS class to assign to the spinner
  		zIndex: 2e9, // The z-index (defaults to 2000000000)
  		top: 'auto', // Top position relative to parent in px
  		left: 'auto' // Left position relative to parent in px
	};
	var loadTarget = document.getElementById('loading');
	var spinner = new Spinner(opts).spin(loadTarget);
	
	////////////////////
	//WINDOW LOAD
	////////////////////
	jQuery(window).load(function(){
		
		loading.stop(true,true).fadeOut(500,function(){
			spinner.stop();
			loading.remove();
		});
		
		
		
	});
	
	//ACCORDION TOGGLES	
	jQuery('.toggleButton').click(function(){
		jQuery(".toggleButton").not(this).removeClass('opened').next().slideUp(400);
		jQuery(".toggleButton").not(this).children('span').html("+");
		jQuery(this).toggleClass('opened').next().slideToggle(400);
		jQuery('.opened').children('span').html("&times;");
		jQuery(this).not('.opened').children('span').html("+");
		jQuery("html,body").animate({scrollTop:0},400);
		jQuery('body.page .entry').slideToggle(400);
	}).hover(function(){
		jQuery(this).stop(true,true).animate({paddingLeft:"10px",backgroundColor:'#99b3cc', color:'#000'},300);
	},function(){
		jQuery(this).stop(true,true).animate({paddingLeft:"8px",backgroundColor:'#333',color:'#fff'},300);
	});
    
    //CLOSE MAIN DIV
    jQuery("#closeBox").live('click', function(){
    	mainBox.fadeOut(400);
    	pageBox.animate({top:"0px"},600);
    	return false;
    }); 
    
    //OPEN MAIN DIV
    pageBox.live('click', function(){
    	jQuery(this).animate({top:"40px"},600);
    	mainBox.fadeIn(400);
    	return false;
    }); 
    
    //WIDGETS TOGGLE
	jQuery('.widgetsToggle').live('click', function(){
		jQuery('#sidebar').slideToggle(400);
		jQuery('.activeInfo').toggleClass('smallInfo');
		jQuery('.widgetsToggle').toggle();
		return false;
	});
	
	//MAP VARS
	var gMap = jQuery('#gMap'),
		containerHeight = jQuery(window).height(),
		marker = jQuery('.marker');
	
	//RESIZE VAR AND FUNCTION
	jQuery(window).resize(function() {
		var containerHeight = jQuery(window).height();
		gMap.css({height:containerHeight});
	});
	
	//GMAP STUFF
	gMap.css({height:containerHeight, width:"100%"});
	
        //NEXT MARKER 
        jQuery('#nextMarker').live('click', function(){
        	var activeMarker = jQuery('.activeMarker');
        	if(activeMarker.is(':not(:last-child)')){
        		activeMarker.removeClass('activeMarker').next('.marker').addClass('activeMarker').mouseover();
        	} else {
        		activeMarker.removeClass('activeMarker');
        		jQuery('.marker:first-child').addClass('activeMarker').mouseover();
        	}
        });
        //PREV MARKER
        jQuery('#prevMarker').live('click', function(){
        	var activeMarker = jQuery('.activeMarker');
        	if(activeMarker.is(':not(:first-child)')){
        		activeMarker.removeClass('activeMarker').prev('.marker').addClass('activeMarker').mouseover();
        	} else {
        		activeMarker.removeClass('activeMarker');
        		jQuery('.marker:last-child').addClass('activeMarker').mouseover();
        	}      
        });
       	//HOVER
        marker.live('mouseover', function(){
        	jQuery('.activeInfo').removeClass('activeInfo').hide();
        	jQuery(this).siblings('.marker').removeClass('activeMarker');
        	jQuery(this).addClass('activeMarker').children('.markerInfo').addClass('activeInfo').stop(true, true).show();
        	jQuery("#target").show();
        });
        //TARGET HOVER
        jQuery("#target").live('mouseover',function(){
        	jQuery(this).hide();
        });
              
    //MAP TYPE
    jQuery(".roadmap").live('click',function(){
    	jQuery("#gMap").gmap3({action: 'setOptions', args:[{mapTypeId:'roadmap'}]}); //hybrid, satellite, roadmap, terrain
    	jQuery(this).removeClass('roadmap').addClass('satellite');
    	jQuery("#mapStyle").toggleClass('satellite');
    });
    jQuery(".satellite").live('click',function(){
    	jQuery("#gMap").gmap3({action: 'setOptions', args:[{mapTypeId:'satellite'}]}); //hybrid, satellite, roadmap, terrain
    	jQuery(this).removeClass('satellite').addClass('roadmap');
    	jQuery("#mapStyle").toggleClass('satellite');
    });
    jQuery("#mapType").live('mouseover', function(){
       jQuery("#mapStyleContainer").stop(true,true).fadeIn(200);
    });
    jQuery("#mapType").live('mouseout', function(){
		jQuery("#mapStyleContainer").stop(true,true).fadeOut(100);
    });
	
	
	

	
});