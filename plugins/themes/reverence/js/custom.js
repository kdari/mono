jQuery.noConflict();

/*********** Scroll to Top ************/
jQuery(function() {
	jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() != 0) {
			jQuery('#toTop').fadeIn();	
		} else {
			jQuery('#toTop').fadeOut();
		}
	});
	jQuery('#toTop').click(function() {
		jQuery('body,html').animate({scrollTop:0},800);
	});	
});
/**************************************/


/************* Top Menu ***************/

jQuery(document).ready(function(){
	
	// Initialize menu
	jQuery('ul.sf-menu').supersubs({ 
		minWidth: 4,  
		maxWidth: 14
		}).superfish({
			autoArrows:false, 
			dropShadows:false,  
			delay: 500, 
			animation: {opacity:'show',height:'show'},  
			easing: 'swing', 
			speed:400
		}); 
	jQuery('ul.sf-menu > li').addClass('top');
	
	// Mobile Menu initialization
	jQuery('.sf-menu').mobileMenu();
	
	// Initialize pretty photo
	//	
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({show_title: false});
});

/**************************************/

jQuery(function(){
	jQuery('a[data-rel]').each(function() {
		jQuery(this).attr('rel', jQuery(this).data('rel'));
	}); 
});	


/********** Portfolio Hover ***********/

jQuery(function(){ 
	jQuery('#portfolio-list li').hover(function() {													  
		jQuery(this).find('.overlay').fadeIn(700);
	},function() {
		jQuery(this).find('.overlay').fadeOut(400);
	});
});

/**************************************/


/*************** TABS *****************/
jQuery(function() {
	jQuery("ul.tabs.tabs-widget").tabs("div.panes.panes-widget > div", {effect:'fade'});
});
/**************************************/

/*********** Hover ************/
jQuery(function() {
	// START
	jQuery(".fade").css("opacity","0.40");
		
		// ON MOUSE OVER
		jQuery(".fade").hover(function () { 
		jQuery(this).stop().animate({
		opacity: 1.0
		}, "slow");
	},
 
	// ON MOUSE OUT
	function () {
		jQuery(this).stop().animate({
		opacity: 0.40
		}, "slow");
	});
});
/**************************************/

// jQuery Input Hints plugin
// Copyright (c) 2009 Rob Volk
// http://www.robvolk.com
jQuery.fn.inputHints=function(){jQuery(this).each(function(i){jQuery(this).val(jQuery(this).attr('title'));});jQuery(this).focus(function(){if(jQuery(this).val()==jQuery(this).attr('title'))
jQuery(this).val('');}).blur(function(){if(jQuery(this).val()=='')
jQuery(this).val(jQuery(this).attr('title'));});};


jQuery(document).ready(function() {

	jQuery(function() {
		jQuery("#foo1").carouFredSel({ width   : "100%",scroll  : 2});
	});
	
	// Input Hints	
    jQuery('input[title], textarea[title]').inputHints();
	
	/*-- Toggles --*/
	
	jQuery('.widget_categories').addClass('main-categories list type1');
	jQuery('.widget_archive').addClass('list type4');
	 
	jQuery('<div class="clear"></div>').insertAfter('.widget_categories ul');
	// Toggles
	jQuery(".toggle-container").hide();
	jQuery(".toggle-trigger").click(function(e){
		e.preventDefault;
		jQuery(this).toggleClass("active").next().slideToggle(100);
		return false;
	});
	//jQuery('.happy-clients ul li:odd').css('float', 'right');
});

/********* Contact Widget *************/
function checkemail(emailaddress){
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i); 
	return pattern.test(emailaddress); 
}

jQuery(document).ready(function(){ 
	jQuery('#registerErrors, .widgetinfo').hide();								
	jQuery('#contactFormWidget input#wformsend').click(function(){ 
		var $name 	= jQuery('#wname').val();
		var $email 	= jQuery('#wemail').val();
		var $message = jQuery('#wmessage').val();
		var $contactemail = jQuery('#wcontactemail').val();
		var $contacturl = jQuery('#wcontacturl').val();
		
		if ($name != '' && $name.length < 3){ $nameshort = true; } else { $nameshort = false; }
		if ($name != '' && $name.length > 30){ $namelong = true; } else { $namelong = false; }
		if ($email != '' && checkemail($email)){ $emailerror = true; } else { $emailerror = false; }
		if ($message != '' && $message != 'Message' && $message.length < 3){ $messageshort = true; } else { $messageshort = false; }
		
		jQuery('#contactFormWidget .loading').animate({opacity: 1}, 250);
		
		if ($name != '' && $nameshort != true && $namelong != true && $email != '' && $emailerror != false && $message != '' && $messageshort != true && $contactemail != ''){ 
			jQuery.post($contacturl, 
				{type: 'widget', contactemail: $contactemail, name: $name, email: $email, message: $message}, 
				function(data){
					jQuery('#contactFormWidget .loading').animate({opacity: 0}, 250);
					jQuery('.form').fadeOut();
					jQuery('#bottom #wname, #bottom #wemail, #bottom #wmessage').css({'border':'0'});
					jQuery('.widgeterror').hide();
					jQuery('.widgetinfo').fadeIn('slow');
					jQuery('.widgetinfo').delay(2000).fadeOut(1000, function(){ 
						jQuery('#wname, #wemail, #wmessage').val('');
						jQuery('.form').fadeIn('slow');
					});
				}
			);
			
			return false;
		} else {
			jQuery('#contactFormWidget .loading').animate({opacity: 0}, 250);
			jQuery('.widgeterror').hide();
			jQuery('.widgeterror').fadeIn('fast');
			jQuery('.widgeterror').delay(3000).fadeOut(1000);
			
			if ($name == '' || $name == 'Name' || $nameshort == true || $namelong == true){ 
				jQuery('#wname').css({'border-left':'4px solid #red'}); 
			} else { 
				jQuery('#wname').css({'border-left':'4px solid #929DAC'}); 
			}
			
			if ($email == '' || $email == 'Email' || $emailerror == false){ 
				jQuery('#wemail').css({'border-left':'4px solid red'}); ; 
			} else { 
				jQuery('#wemail').css({'border-left':'4px solid #929DAC'}); 
			}
			
			if ($message == '' || $message == 'Message' || $messageshort == true){ 
				jQuery('#wmessage').css({'border-left':'4px solid red'}); 
			} else { 
				jQuery('#wmessage').css({'border-left':'4px solid #929DAC'}); 
			}
			
			return false;
		}
	});
});
/**************************************/

	
jQuery(document).ready(function(){ 
	jQuery('.tooltip').hover(function() {
		this.tip = this.title;
		jQuery(this).append('<div class="toolTipWrapper"><span class="tip">'+this.tip+'</span></div>');
		this.title = "";
		this.width = jQuery(this).width();
		jQuery(this).find('.toolTipWrapper').css('left', -(this.width)-10);
		jQuery(this).find('.toolTipWrapper').css('top', 30);
		jQuery('.toolTipWrapper').fadeIn(300);
	},
	function() {
		jQuery('.toolTipWrapper').fadeOut(100);
		jQuery(this).find('.toolTipWrapper').remove();
			this.title = this.tip;
		}
	);
    
	
	// Under construction form
	jQuery('#ucerror, .errorarr').css('display', 'none');
	jQuery('.ucform').submit(function() {
		var $email 	= jQuery('#ucemail').val();  
		if ($email != '' && checkemail($email)){ $emailerror = true; } else { $emailerror = false; }
		if ($email == '' || $emailerror == false){ 
			jQuery('#ucemail').css({'border-left':'4px solid red'}); 
			jQuery('#ucerror').html('Please enter a valid e-mail address')
			jQuery('#ucerror, .errorarr').show('normal');
		} else { 
			jQuery('#ucemail').css({'border':'none'});
			jQuery('#ucerror').html('We will inform you of the updates.');
			jQuery('#ucerror, .errorarr').show('normal');
		
		}
	  	
	  return false;
	}); 
});

/**** About Page ***/
jQuery(document).ready(function() {

	jQuery('.carousel').carouFredSel({
		responsive : true,
		width:'92%',
		scroll: 2,
		items: {width: 200,visible: {min: 1,max: 5}},
		next : '.car-next',
		prev : '.car-prev',
		auto: true
	});
});



var d = document;
var safari = (navigator.userAgent.toLowerCase().indexOf('safari') != -1) ? true : false;
var gebtn = function(parEl,child) { return parEl.getElementsByTagName(child); };
onload = function() {

    var body = gebtn(d,'body')[0];
    body.className = body.className && body.className != '' ? body.className + ' has-js' : 'has-js';

    if (!d.getElementById || !d.createTextNode) return;
    var ls = gebtn(d,'label');
    for (var i = 0; i < ls.length; i++) {
        var l = ls[i];
        if (l.className.indexOf('label_') == -1) continue;
        var inp = gebtn(l,'input')[0];
        if (l.className == 'label_check') {
            l.className = (safari && inp.checked == true || inp.checked) ? 'label_check c_on' : 'label_check c_off';
            l.onclick = check_it;
        };
        if (l.className == 'label_radio') {
            l.className = (safari && inp.checked == true || inp.checked) ? 'label_radio r_on' : 'label_radio r_off';
            l.onclick = turn_radio;
        };
    };
};
var check_it = function() {
    var inp = gebtn(this,'input')[0];
    if (this.className == 'label_check c_off' || (!safari && inp.checked)) {
        this.className = 'label_check c_on';
        if (safari) inp.click();
    } else {
        this.className = 'label_check c_off';
        if (safari) inp.click();
    };
};
var turn_radio = function() {
    var inp = gebtn(this,'input')[0];
    if (this.className == 'label_radio r_off' || inp.checked) {
        var ls = gebtn(this.parentNode,'label');
        for (var i = 0; i < ls.length; i++) {
            var l = ls[i];
            if (l.className.indexOf('label_radio') == -1)  continue;
            l.className = 'label_radio r_off';
        };
        this.className = 'label_radio r_on';
        if (safari) inp.click();
    } else {
        this.className = 'label_radio r_off';
        if (safari) inp.click();
    };
};

/*
* Copyright (C) 2009 Joel Sutherland
* Licenced under the MIT license
* http://www.newmediacampaigns.com/page/jquery-flickr-plugin
*
* Available tags for templates:
* title, link, date_taken, description, published, author, author_id, tags, image*
*/
(function($){$.fn.jflickrfeed=function(settings,callback){settings=$.extend(true,{flickrbase:'http://api.flickr.com/services/feeds/',feedapi:'photos_public.gne',limit:20,qstrings:{lang:'en-us',format:'json',jsoncallback:'?'},cleanDescription:true,useTemplate:true,itemTemplate:'',itemCallback:function(){}},settings);var url=settings.flickrbase+settings.feedapi+'?';var first=true;for(var key in settings.qstrings){if(!first)
url+='&';url+=key+'='+settings.qstrings[key];first=false;}
return $(this).each(function(){var $container=$(this);var container=this;$.getJSON(url,function(data){$.each(data.items,function(i,item){if(i<settings.limit){if(settings.cleanDescription){var regex=/<p>(.*?)<\/p>/g;var input=item.description;if(regex.test(input)){item.description=input.match(regex)[2]
if(item.description!=undefined)
item.description=item.description.replace('<p>','').replace('</p>','');}}
item['image_s']=item.media.m.replace('_m','_s');item['image_t']=item.media.m.replace('_m','_t');item['image_m']=item.media.m.replace('_m','_m');item['image']=item.media.m.replace('_m','');item['image_b']=item.media.m.replace('_m','_b');delete item.media;if(settings.useTemplate){var template=settings.itemTemplate;for(var key in item){var rgx=new RegExp('{{'+key+'}}','g');template=template.replace(rgx,item[key]);}
$container.append(template)}
settings.itemCallback.call(container,item);}});if($.isFunction(callback)){callback.call(container,data);}});});}})(jQuery);
