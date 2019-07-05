$j = jQuery.noConflict();

$j(function(){

	var isTouch = navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad|android)/);

	headerHeight();

	Tabs();

	Wpml_change_flag();

	CustomizeMenu();

	RollUpMenu();

	RollUpTopStrip();

	ApplyColorbox();

	ApplyFancyboxVideo();

	InitMisc();

	HoverZoomInit();

	OpenCloseShortcode();

	PrettySociableInit();

  if($j(".3d-slider-container").length > 0)
  {
    $j("#slider-holder").addClass("slider-3d-holder");
  }

  widgetsSize();
});

function headerHeight(){
  var using = $j('#header-background-using').text();
  if(using == "TopImage"){
    $j('.background').css({"height":$j(".pattern").height(),"width":"100%"});
  } else if (using == "BottomImage") {
    var headerHeight = $j("#header-background-height").text() - $j(".header-container").height();
    $j('.background').css({"height":$j("#header-background-height").text()+"px","width":"100%"});
    $j('.slider').css({'height':headerHeight-10});
    $j('#slider-container').css({'height':headerHeight-10});
    $j('.anythingSlider').css({'height':headerHeight-10});
  } else {
  
  }
}

function widgetsSize() {
	i=0;
	$j('div.footer-widgets-container > div.box').each( function() {
		$j('div.footer-widgets-container > div.box').eq(i).addClass('col-' + (i+1));
	i++;
	});
}

function PrettySociableInit(){

	var homeUrl = $j("body").data("themeurl");
	$j.prettySociable({websites: {
				facebook : {
					'active': true,
					'encode':true, // If sharing is not working, try to turn to false
					'title': 'Facebook',
					'url': 'http://www.facebook.com/share.php?u=',
					'icon':homeUrl+'/design/img/prettySociable/large_icons/facebook.png',
					'sizes':{'width':70,'height':70}
				},
				twitter : {
					'active': true,
					'encode':true, // If sharing is not working, try to turn to false
					'title': 'Twitter',
					'url': 'http://twitter.com/home?status=',
					'icon':homeUrl+'/design/img/prettySociable/large_icons/twitter.png',
					'sizes':{'width':70,'height':70}
				},
				delicious : {
					'active': true,
					'encode':true, // If sharing is not working, try to turn to false
					'title': 'Delicious',
					'url': 'http://del.icio.us/post?url=',
					'icon':homeUrl+'/design/img/prettySociable/large_icons/delicious.png',
					'sizes':{'width':70,'height':70}
				},
				digg : {
					'active': true,
					'encode':true, // If sharing is not working, try to turn to false
					'title': 'Digg',
					'url': 'http://digg.com/submit?phase=2&url=',
					'icon':homeUrl+'/design/img/prettySociable/large_icons/digg.png',
					'sizes':{'width':70,'height':70}
				},
				linkedin : {
					'active': true,
					'encode':true, // If sharing is not working, try to turn to false
					'title': 'LinkedIn',
					'url': 'http://www.linkedin.com/shareArticle?mini=true&ro=true&url=',
					'icon':homeUrl+'/design/img/prettySociable/large_icons/linkedin.png',
					'sizes':{'width':70,'height':70}
				},
				reddit : {
					'active': true,
					'encode':true, // If sharing is not working, try to turn to false
					'title': 'Reddit',
					'url': 'http://reddit.com/submit?url=',
					'icon':homeUrl+'/design/img/prettySociable/large_icons/reddit.png',
					'sizes':{'width':70,'height':70}
				},
				stumbleupon : {
					'active': true,
					'encode':false, // If sharing is not working, try to turn to false
					'title': 'StumbleUpon',
					'url': 'http://stumbleupon.com/submit?url=',
					'icon':homeUrl+'/design/img/prettySociable/large_icons/stumbleupon.png',
					'sizes':{'width':70,'height':70}
				},
				tumblr : {
					'active': true,
					'encode':true, // If sharing is not working, try to turn to false
					'title': 'tumblr',
					'url': 'http://www.tumblr.com/share?v=3&u=',
					'icon':homeUrl+'/design/img/prettySociable/large_icons/tumblr.png',
					'sizes':{'width':70,'height':70}
				}
			}});
}

function Wpml_change_flag()
{
  var flag = $j('.wpml-content li:first-child').find('img').attr('src');

  $j('#wpml-current-lang').attr({'src':flag});
}

function CustomizeMenu(){
	$j(".mainmenu > ul > li").each(function(){
		if($j(this).has('ul').length){
			$j(this).addClass("parent");
		}
	});
}

function RollUpMenu(){
	  var time = parseInt($j('#mainmenu-dropdown-duration').text());
    var easing = $j('#mainmenu-dropdown-easing').text();

    $j(".mainmenu ul").find('ul').each(function(){
      $j(this).css({'display':'block', 'visibility':'none'});
    });

    $j(".mainmenu").find('ul').children('li').each(function(){
      if($j(this).has('ul').length){
        var submenu = $j(this).children('ul');
        var submenuHeight =  submenu.height();
        $j(this).hover(function(){
          submenu.css({'display':'block', 'height':'0'}).stop(true,true).animate({'height':submenuHeight}, time, easing);
        }, function(){
          submenu.css({'display':'none','height':submenuHeight});
        });
      }
    });

    $j(".mainmenu ul").find('ul').each(function(){
      $j(this).css({'display':'none', 'visibility':'block'});
    });
}

function RollUpTopStrip(){
    var time = parseInt($j('#topstrip-dropdown-duration').text());
    var easing = $j('#topstrip-dropdown-easing').text();
  
    $j(".strip-box-content ul").children('li').each(function(){
      $j(this).children('div').css({'display':'block', 'visibility':'none'});
    });
  
    $j(".strip-box-content ul").children('li').each(function(){
      
        var content = $j(this).children('div');
        var contentHeight =  content.height();
        $j(this).hover(function(){
          content.css({'display':'block', 'height':'0'}).stop(true,true).animate({'height':contentHeight}, time, easing);
        }, function(){
          content.css({'display':'none','height':contentHeight});
        });
    });
  
    $j(".strip-box-content ul").children('li').each(function(){
      $j(this).children('div').css({'display':'none', 'visibility':'block'});
    });
}

function ApplyColorbox(){
	// Apply fancybox on all images
	$j("a[href$='gif']").colorbox({rel: 'group', maxHeight:"95%"});
	$j("a[href$='jpg']").colorbox({rel: 'group', maxHeight:"95%"});
	$j("a[href$='png']").colorbox({rel: 'group', maxHeight:"95%"});
}
function ApplyFancyboxVideo(){
	// AIT-Portfolio videos
	$j(".ait-portfolio a.video-type").click(function() {

		var address = this.href
		if(address.indexOf("youtube") != -1){
			// Youtube Video
			$j.fancybox({
				'padding'		: 0,
				'autoScale'		: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'title'			: this.title,
				'width'			: 680,
				'height'		: 495,
				'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
				'type'			: 'swf',
				'swf'			: {
					'wmode'		: 'transparent',
					'allowfullscreen'	: 'true'
				}
			});
		} else if (address.indexOf("vimeo") != -1){
			// Vimeo Video
			// parse vimeo ID
			var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
			var match = this.href.match(regExp);

			if (match){
			    $j.fancybox({
					'padding'		: 0,
					'autoScale'		: false,
					'transitionIn'	: 'elastic',
					'transitionOut'	: 'elastic',
					'title'			: this.title,
					'width'			: 680,
					'height'		: 495,
					'href'			: "http://player.vimeo.com/video/"+match[2]+"?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff",
					'type'			: 'iframe'
				});
			} else {
			    alert("not a vimeo url");
			}
		}
		return false;
	});

	// Images shortcode
	$j("a.sc-image-link.video-type").click(function() {

		var address = this.href
		if(address.indexOf("youtube") != -1){
			// Youtube Video
			$j.fancybox({
				'padding'		: 0,
				'autoScale'		: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'title'			: this.title,
				'width'			: 680,
				'height'		: 495,
				'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
				'type'			: 'swf',
				'swf'			: {
					'wmode'		: 'transparent',
					'allowfullscreen'	: 'true'
				}
			});
		} else if (address.indexOf("vimeo") != -1){
			// Vimeo Video
			// parse vimeo ID
			var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
			var match = this.href.match(regExp);

			if (match){
			    $j.fancybox({
					'padding'		: 0,
					'autoScale'		: false,
					'transitionIn'	: 'elastic',
					'transitionOut'	: 'elastic',
					'title'			: this.title,
					'width'			: 680,
					'height'		: 495,
					'href'			: "http://player.vimeo.com/video/"+match[2]+"?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff",
					'type'			: 'iframe'
				});
			} else {
			    alert("not a vimeo url");
			}
		}
		return false;
	});
}


function InitMisc() {
  $j('#content input, #content textarea').each(function(index) {
    var id = $j(this).attr('id');
    var name = $j(this).attr('name');
    if (id.length == 0 && name.length != 0) {
      $j(this).attr('id', name);
    }
  });

  $j('#content label').inFieldLabels();

  $j('.rule span').click(function() {
	  $j.scrollTo(0, 1000, {axis:'y'});
	  return false;
 });

}


function HoverZoomInit() {
  //// Post images
  //$j('#content .entry-thumbnail a').hoverZoom({overlayColor:'#333333',overlayOpacity: 0.8});

  // default wordpress gallery
  $j('#content .gallery-item a').hoverZoom({overlayColor:'#333333',overlayOpacity: 0.8,zoom:0});

  // ait-portfolio
  $j('#content .ait-portfolio a').hoverZoom({overlayColor:'#333333',overlayOpacity: 0.8,zoom:0});

  // schortcodes
  $j('#content a.sc-image-link').hoverZoom({overlayColor:'#333333',overlayOpacity: 0.8,zoom:0});

}


function OpenCloseShortcode(){

	//$j('#content .frame .frame-close.closed').parent().find('.frame-wrap').hide();
	$j('#content .frame .frame-close.closed .close.text').hide();
	$j('#content .frame .frame-close.closed .open.text').show();

	$j('#content .frame .frame-close').click(function(){
		if($j(this).hasClass('closed')){
			var $butt = $j(this);
			$j(this).parent().find('.frame-wrap').slideDown('slow',function(){
				$butt.removeClass('closed');
				$butt.find('.close.text').show();
				$butt.find('.open.text').hide();
			});
		} else {
			var $butt = $j(this);
			$j(this).parent().find('.frame-wrap').slideUp('slow',function(){
				$butt.addClass('closed');
				$butt.find('.close.text').hide();
				$butt.find('.open.text').show();
			});

		}

	});
}

/**
 * *********** Tabs ************
 */
function Tabs()
{
	$j.fn.aitTabs = function(){
		return this.each(function(){
			var $container = $j(this),
				$tabs = $j('<ul>', {'class': 'tabs'}),
				$panels = $container.find('.tab-panel'),
				$widgetTitles = $panels.find('.widget-title');

			$widgetTitles.each(function(i){
				var $this = $j(this);
				var activeClass = '';
				var href = $panels[i].id;
				var title = $this.text();

				if(!/\S/.test(title)) // title is empty or has only white spaces
					title = '[Add widget title in admin]';

				if(i == 0) // first tab is active
					activeClass = ' class="tab-active"';

				$this.remove();
				$tabs.append('<li' + activeClass + '><a href="#' + href + '">' + title + '</a></li>');
			});

			$container.prepend($tabs);

			// Do magic with tabs (switching tabs :)
			var activeTabId = $tabs.find('.tab-active a').attr('href');

			$panels.filter($j(activeTabId)).css({'display': 'block'});

			$tabs.find('a').click(function(){
				var $this = $j(this);
				$tabs.find('.tab-active').removeClass('tab-active');
				activeTabId = $this.attr('href');
				$this.parent().addClass('tab-active');
				$panels.css({'display': 'none'}).filter($j(activeTabId)).fadeIn();
				return false;
			});

		});
	}

	var $c = $j('.tabs-container');

	if($c.length){
		$c.aitTabs();
	}
	try{
		Cufon.refresh();
	}catch(e){}
}