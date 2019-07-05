<?php header("Content-type: text/xml");
require_once('../../../../../wp-load.php');
$al_options = get_option('al_general_settings'); 
$imgwidth = isset($al_options['al_slider3dimgw']) ? $al_options['al_slider3dimgw'] : 980; 
$imgheight = isset($al_options['al_slider3dimgh']) ? $al_options['al_slider3dimgh'] : 377; 
$items = '';
$prepend ='
<Piecemaker>
	<Contents>';
		$loop = new WP_Query( array( 'post_type' => 'slider', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
		
		while ( $loop->have_posts() ) : $loop->the_post();
			
			$custom = get_post_custom($post->ID);
			
			$getthumb = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'full') ;
			//$thumbnail = strstr($getthumb[0], 'uploads/');
			
			$title = htmlspecialchars (the_title('','',false));
			$desc = htmlspecialchars(get_the_content());
			
			$link = (isset($custom['_slider_link'][0])) ? $custom['_slider_link'][0] : '';
			$slidevideo = '';//$custom["_slider_video"][0];
			if (empty($slidevideo))
			{
				$items.='<Image Source="'.$getthumb[0].'" Title="'.$title.'">';
				
				if ($desc != '')
				$items.='<Text>'.$desc.'</Text>';
				if ($link != '')
				$items.='<Hyperlink URL="'.$link.'" Target="_blank" />';
				
				$items.='</Image>';
			}
			else
			{
				$items.='<Video Source="'.$slidevideo.'" Title="'.$title.'" Width="'.$imgwidth.'" Height="'.$imgheight.'" Autoplay="true">
				  <Image Source="'.$getthumb[0].'" />
				</Video>';
			}
		endwhile; 
$items.='</Contents>';
$items.='<Settings 
		ImageWidth="'.$imgwidth.'" 
		ImageHeight="'.$imgheight.'" 
		LoaderColor="'.$al_options['al_3D_loadercolor'].'" 
		InnerSideColor="'.$al_options['al_3D_iscolor'].'" 
		SideShadowAlpha="'.$al_options['al_3D_SideShadowAlpha'].'" 
		DropShadowAlpha="'.$al_options['al_3D_DropShadowAlpha'].'" 
		DropShadowDistance="'.$al_options['al_3D_DropShadowDistance'].'" 
		DropShadowScale="'.$al_options['al_3D_DropShadowScale'].'" 
		DropShadowBlurX="'.$al_options['al_3D_DropShadowBlurX'].'" 
		DropShadowBlurY="'.$al_options['al_3D_DropShadowBlurY'].'" 
		MenuDistanceX="'.$al_options['al_3D_MDX'].'" 
		MenuDistanceY="'.$al_options['al_3D_MDY'].'" 
		MenuColor1="'.$al_options['al_3D_Menu_Color1'].'" 
		MenuColor2="'.$al_options['al_3D_Menu_Color2'].'" 
		MenuColor3="'.$al_options['al_3D_Menu_Color3'].'" 
		ControlSize="'.$al_options['al_3D_Control_Size'].'" 
		ControlDistance="'.$al_options['al_3D_Control_Distance'].'" 
		ControlColor1="'.$al_options['al_3D_Control_Color1'].'" 
		ControlColor2="'.$al_options['al_3D_Control_Color2'].'" 
		ControlAlpha="'.$al_options['al_3D_Control_Alpha'].'" 
		ControlAlphaOver="'.$al_options['al_3D_Control_Alpha_Over'].'" 
		ControlsX="'.$al_options['al_3D_Controls_X'].'" 
		ControlsY="'.$al_options['al_3D_Controls_Y'].'" 
		ControlsAlign="'.$al_options['al_3D_Control_Align'].'" 
		TooltipHeight="'.$al_options['al_3D_Tooltip_Height'].'" 
		TooltipColor="'.$al_options['al_3D_Tooltip_Color'].'"
		TooltipTextY="'.$al_options['al_3D_Tooltip_Text_Y'].'" 
		TooltipTextStyle="'.$al_options['al_3D_Tooltip_Text_Style'].'" 
		TooltipTextColor="'.$al_options['al_3D_Tooltip_Text_Color'].'" 
		TooltipMarginLeft="'.$al_options['al_3D_Tooltip_Margin_Left'].'" 
		TooltipMarginRight="'.$al_options['al_3D_Tooltip_Margin_Right'].'" 
		TooltipTextSharpness="'.$al_options['al_3D_Tooltip_Text_Sharpness'].'" 
		TooltipTextThickness="'.$al_options['al_3D_Tooltip_Text_Thickness'].'" 		
		InfoWidth="'.$al_options['al_3D_Info_Width'].'" 
		InfoBackground="'.$al_options['al_3D_Info_Background'].'" 
		InfoBackgroundAlpha="'.$al_options['al_3D_Info_Background_Alpha'].'" 		
		InfoMargin="'.$al_options['al_3D_Info_Margin'].'" 
		InfoSharpness="'.$al_options['al_3D_Info_Sharpness'].'" 
		InfoThickness="'.$al_options['al_3D_Info_Thickness'].'" 
		Autoplay="'.$al_options['al_3D_Autoplay'].'" 
		FieldOfView="'.$al_options['al_3D_FieldOfView'].'">
		</Settings>';
$items.='
	<Transitions>
		<Transition Pieces="9" Time="1.2" Transition="easeInOutBack" Delay="0.1" DepthOffset="300" CubeDistance="30"></Transition>
		<Transition Pieces="15" Time="3" Transition="easeInOutElastic" Delay="0.03" DepthOffset="200" CubeDistance="10"></Transition>
		<Transition Pieces="5" Time="1.3" Transition="easeInOutCubic" Delay="0.1" DepthOffset="500" CubeDistance="50"></Transition>
		<Transition Pieces="9" Time="1.25" Transition="easeInOutBack" Delay="0.1" DepthOffset="900" CubeDistance="5"></Transition>
	</Transitions>';

$items.='</Piecemaker>';

$final =  $prepend.$items;

echo $final; die();
?>