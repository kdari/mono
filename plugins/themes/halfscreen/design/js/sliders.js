// Jquery no conflict mode
$j = jQuery.noConflict();

/* ******************************************************************************************
 * Bootstrap
 * ******************************************************************************************/
$j(document).ready(function() {
	$j('#preload-background-slider-images').imagesLoaded(function(){
		InitSlider();
		Cufon.refresh();
	});
});

function InitSlider() {
	if($j('.header').has('ul#slider').length){

	  var delay = parseInt($j('#slider-delay').text());
	  var animTime = parseInt($j('#slider-animTime').text());
	  
	  $j('#slider').css("width","1000px");
	  
	  // according to the background image
	  if(!($j('#slider > li:first > a').has('img').length)){
	  	
		//var backSliderHeight = parseInt($j('#slider > li:first > div.background-image img').attr("height"));
		
		var backSliderHeight = parseInt($j('#preload-background-slider-images > img:first').attr("height"));
		
		var headerHeight = parseInt($j('.header-container').height());
		var paddingTop = parseInt($j('#slider-holder').css('padding-top'));
		var paddingBottom = parseInt($j('#slider-holder').css('padding-bottom'));
		
		var sliderHeight = backSliderHeight - headerHeight - paddingTop - paddingBottom;
		
	  	$j('#slider').css("height",sliderHeight+"px");
	  	
	  	$j('.header-layout .background').css("height",backSliderHeight+"px");
	  	
	  // according to the top image	
	  } else {
	  	
	  	var topSliderHeight = parseInt($j('#slider > li:first > a > img').attr("height"));
	  	var headerHeight = parseInt($j('.header-container').height());
		var paddingTop = parseInt($j('#slider-holder').css('padding-top'));
		var paddingBottom = parseInt($j('#slider-holder').css('padding-bottom'));
		
		var backSliderHeight = topSliderHeight + headerHeight + paddingTop + paddingBottom;
		
	  	$j('#slider').css("height",topSliderHeight+"px");
	  	
	  	$j('.header-layout .background').css("height",backSliderHeight+"px");
	  	
	  }
	  
	  if(isNaN(delay)){
	  	delay = 3000;
	  }
	  if(isNaN(animTime)){
	  	animTime = 600;
	  }

	  var actualSlide = 0;

	  $j('#slider').anythingSlider({
	  	  autoPlay: true,
	  	  pauseOnHover: true,
	  	  autoPlayLocked: true,
	  	  resumeOnVideoEnd    : true,
	  	  autoPlayDelayed     : true,
		  delay               : delay,
		  animationTime       : animTime,
		  resumeDelay         : delay,
		 onInitialized       : function(e, slider){
			$j('div.anythingSlider').find('div[class*=caption]').css({'display':'block'});
			var newBackground = slider.$currentPage.find("div.background-image img").attr("src");
			var newBgColor = slider.$currentPage.find("div.background-color").text();
			var newBgRep = slider.$currentPage.find("div.background-repeat").text();
			var newBgPosX = slider.$currentPage.find("div.background-posX").text();
			var newBgPosY = slider.$currentPage.find("div.background-posY").text();
			if(newBackground){
				$j("#main-header-background-top").show();
				$j("#main-header-background-bottom").show();
				//$j("#main-header-background-top img").attr("src",newBackground);
				$j("#main-header-background-top").css("background-image", "url('"+newBackground+"')");
				$j("#main-header-background-top").css('background-color', newBgColor);
				$j("#main-header-background-top").css('background-repeat', newBgRep);
				$j("#main-header-background-top").css('background-position', newBgPosX + " " + newBgPosY);
			}
    	 	
		 },
    	 onSlideInit         : function(e, slider){
    	  	// set bottom background image
    	  	var newBackground = slider.$targetPage.find("div.background-image img").attr("src");
    	  	var newBgColor = slider.$targetPage.find("div.background-color").text();
    			var newBgRep = slider.$targetPage.find("div.background-repeat").text();
    			var newBgPosX = slider.$targetPage.find("div.background-posX").text();
    			var newBgPosY = slider.$targetPage.find("div.background-posY").text();
			if(newBackground){
				$j("#main-header-background-bottom").show();
				
				//$j("#main-header-background-bottom img").attr("src",newBackground);
				$j("#main-header-background-bottom").css("background-image","url('"+newBackground+"')");
				$j("#main-header-background-bottom").css('background-color', newBgColor);
				$j("#main-header-background-bottom").css('background-repeat', newBgRep);
				$j("#main-header-background-bottom").css('background-position', newBgPosX + " " + newBgPosY);
				$j("#main-header-background-top").fadeOut(animTime);
				$j("#main-header-background-bottom").fadeIn(animTime);

			} else {
				$j("#main-header-background-top").fadeOut(animTime);
				
				$j("#main-header-background-bottom").hide();
				$j("#main-header-background-top").show();
			}
			
    	 },
    	 onSlideComplete     : function(slider){
			// set top background image
			var newTopBackground = slider.$currentPage.find("div.background-image img").attr("src");
			var newBgColor = slider.$currentPage.find("div.background-color").text();
			var newBgRep = slider.$currentPage.find("div.background-repeat").text();
			var newBgPosX = slider.$currentPage.find("div.background-posX").text();
			var newBgPosY = slider.$currentPage.find("div.background-posY").text();
			if(newTopBackground){
				//$j("#main-header-slider-bottom").show();
				//$j("#main-header-background-top img").attr("src",newTopBackground);
				//$j("#main-header-background-bottom").fadeIn(animTime);
				$j("#main-header-background-top").css({"background-image":"url('"+newTopBackground+"')"});
				$j("#main-header-background-top").css({'background-color':newBgColor});
				$j("#main-header-background-top").css({'background-repeat':newBgRep});
				$j("#main-header-background-top").css({'background-position':newBgPosX + " " + newBgPosY});
				$j("#main-header-background-top").fadeIn(animTime);
				//$j("#main-header-background-top").fadeIn(animTime);
				//$j("#main-header-background-bottom").fadeOut(animTime);
			} else {
				$j("#main-header-background-top").hide();
			}
    	 	
    	 }
	  }).css("visibility","visible");
	  
	  $j('div.anythingSlider .forward').hide();
	  $j('div.anythingSlider .back').hide();
	  $j('div.anythingSlider .start-stop').hide();

	}
	
}