jQuery.noConflict();

/*-------------------------------------------    
	 Dropdown
-------------------------------------------*/

		jQuery(document).ready(function() {
			jQuery('nav ul > li').hover(
				function () {
					jQuery(this).find("ul:first").show();
				}, 
				function () {
					jQuery(this).find("ul:first").fadeOut();
				}
			);		
		})
		
		
/*-------------------------------------------    
	 Show / Hide Input Values
-------------------------------------------*/		

		/* Your Comments */

		jQuery(document).ready(function() {
	
			jQuery("#comment-text").attr("value", "Your Comments");
			var text = "Your Comments";
	
			jQuery("#comment-text").focus(function() {
				jQuery(this).addClass("active");
				if(jQuery(this).attr("value") == text) jQuery(this).attr("value", "");
			});
	
			jQuery("#comment-text").blur(function() {
				jQuery(this).removeClass("active");
				if(jQuery(this).attr("value") == "") jQuery(this).attr("value", text);
			});		
	
		});

		/* Name / Nickname */

		jQuery(document).ready(function() {
			
			jQuery("#name-input").attr("value", "Your Name / Nick");
			var text = "Your Name / Nick";
			
			jQuery("#name-input").focus(function() {
				jQuery(this).addClass("active");
				if(jQuery(this).attr("value") == text) jQuery(this).attr("value", "");
			});
			
			jQuery("#name-input").blur(function() {
				jQuery(this).removeClass("active");
				if(jQuery(this).attr("value") == "") jQuery(this).attr("value", text);
			});		
			
		});
		
		/* Your Email */

		jQuery(document).ready(function() {

			jQuery("#email-input").attr("value", "Your Email");
			var text = "Your Email";

			jQuery("#email-input").focus(function() {
				jQuery(this).addClass("active");
				if(jQuery(this).attr("value") == text) jQuery(this).attr("value", "");
			});

			jQuery("#email-input").blur(function() {
				jQuery(this).removeClass("active");
				if(jQuery(this).attr("value") == "") jQuery(this).attr("value", text);
			});	
			
		});

		/* Your Website */

		jQuery(document).ready(function() {

			jQuery("#web-input").attr("value", "Your Website");
			var text = "Your Website";

			jQuery("#web-input").focus(function() {
				jQuery(this).addClass("active");
				if(jQuery(this).attr("value") == text) jQuery(this).attr("value", "");
			});

			jQuery("#web-input").blur(function() {
				jQuery(this).removeClass("active");
				if(jQuery(this).attr("value") == "") jQuery(this).attr("value", text);
			});	
			
		});