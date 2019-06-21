<?php
/* **********************************************************
 * jQuery UI Tabs
 * **********************************************************/
function theme_tabs( $params, $content = null) {
    extract( shortcode_atts( array(
    	'id' => rand(100,1000),
        'ver' => $GLOBALS['aitThemeShortcodes']['tabs']
    ), $params ) );
		
	$scontent = do_shortcode($content);
	if(trim($scontent) != ""){
		$output = '<div class="ait-tabs" id="ait-tabs-'.$id.'"><ul>'.$scontent.'</ul>';
		$output .= '</div>';
		$output .= '<script type="text/javascript">
		$j(function() {
			// remove br and p
			$j( "#ait-tabs-'.$id.' ul > br" ).remove();
			$j( "#ait-tabs-'.$id.' ul > p" ).remove();
			
			var tabId = 0;
			$j( "#ait-tabs-'.$id.' ul li" ).each(function(){
				tabId++;
				var tabName = "tab-'.$id.'-"+tabId;
				$j(this).find("a.tab-link").attr("href","#"+tabName);
				var tabContent = $j(this).find(".tab-content").html();
				$j( "#ait-tabs-'.$id.'" ).append("<div id="'.'+tabName+'.'">"+tabContent+"</div>");
			});
			
			$j( "#ait-tabs-'.$id.'" ).tabs();
			$j( "#ait-tabs-'.$id.'").addClass("ait-tabs");
			Cufon.refresh();
		});
		</script>';
		
		return $output;
	} else {
		return "";
	}
}
add_shortcode( 'tabs', 'theme_tabs' );

function theme_tab( $params, $content = null) {
    extract( shortcode_atts( array(
        'title' => 'title'
    ), $params ) );

	return '<li><a class="tab-link" href="">'.$title.'</a><div class="tab-content" style="display: none;">'.do_shortcode(trim($content)).'</div></li>';
	
}
add_shortcode( 'tab', 'theme_tab' );