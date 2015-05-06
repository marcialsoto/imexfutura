<?php

	global $cl_redata;

	extract(shortcode_atts(array(

	  "type" => 'in_container',

	  'bg_image'=> '', 

	  'bg_position'=> '', 

	  'bg_repeat' => '', 

	  'parallax_bg' => '', 

	  'bg_color'=> '',

	  'overlay'=> '', 

	  'overlay_color'=> '',  

	  

	  'video_bg'=> '', 

	  'video_webm'=> '', 

	  'video_mp4'=> '', 

	  

	  "top_padding" => "", 

	  "bottom_padding" => "",

	  'text_color' => 'dark',  

	  'custom_text_color' => '',  

	  'transparency' => '',

	  'borders' => '',

	  'class' => ''), 

	$atts));

	

	wp_enqueue_style( 'js_composer_front' );

	wp_enqueue_script( 'wpb_composer_front_js' );

	

    $style = null;

	$etxra_class = null;

	$bg_im = '';

	if(!empty($bg_image)) {

			

		if(strpos($bg_image, "http://") !== false){

				
			if(!$parallax_bg){
				$style .= 'background-image: url('. esc_url($bg_image) . '); ';

				$style .= 'background-position: '. $bg_position .'; ';
			}
			

			$bg_im = $bg_image;

		} else {

			$bg_image_src = wp_get_attachment_image_src($bg_image, 'full');

			
			if(!$parallax_bg){
				$style .= 'background-image: url('. esc_url($bg_image_src[0]). '); ';

				$style .= 'background-position: '. $bg_position .'; ';
			}
			

			$bg_im = $bg_image_src[0];

		}

		

		//for pattern bgs

		if(strtolower($bg_repeat) == 'repeat'){

			$style .= 'background-repeat: '. strtolower($bg_repeat) .'; ';

			$etxra_class = 'no-cover';

		} else {

			$style .= 'background-repeat: '. strtolower($bg_repeat) .'; ';

			$etxra_class = null;

		}

	}

	

	if(!empty($bg_color)) {

		if($bg_color == 'base'){
			$bg_color = $cl_redata['primary_color'];
		}

		$style .= 'background-color: '. $bg_color.'; ';

	}

	

	if(strtolower($parallax_bg) == 'true'){

		$parallax_class = 'parallax_section';

	} else {

		$parallax_class = '';

	}

	
	if($top_padding != '')
		$style .= 'padding-top: '. $top_padding .'px ; ';
	if($bottom_padding != '')
		$style .= 'padding-bottom: '. $bottom_padding .'px ; ';

	

	if($text_color == 'custom' && !empty($custom_text_color)) {

		$style .= 'color: '. $custom_text_color .'; ';

	}

	

	//main class

	if($type == 'in_container') {

		

		$main_class = "standard_section ";

		

	} else if($type == 'full_width_background'){

		

		$main_class = "section-style ";

		

	} else if($type == 'full_width_content'){

		

		$main_class = "full-width-content section-style ";

	}

	

	if($video_bg)

		$etxra_class .= ' video_section '; 

	 

	$video_markup = '';

	$overlay_markup = ''; 

	$parallax_markup = '';

	if($video_bg) {



		$video_markup = '<div class="video-wrap"><video id="video_background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0"> 

                                                                        <source src="'.esc_url($video_webm).'" type="video/webm"> 

                                                                        <source src="'.esc_url($video_mp4).'" type="video/mp4"> 

                                                      

                                                                        Video not supported </video></div>';

	

	} 



	if($overlay){
		if(strpos($overlay_color, "#") !== false)
			$overlay_color = 'rgba('.implode(',', codeless_hexToRgb($overlay_color)).',0.8 )';
		$overlay_markup = '<div class="bg-overlay" style="background:'.$overlay_color.';"></div>';

	}
	$animate_onoffset = '';
	$animate_onoffset_c = '';
	if($parallax_bg){

		$style .= ' background-image: url('.esc_url($bg_im).'); background-position: 50% 0px; ';
		$animate_onoffset_c = 'animate_onoffset';
	}else
		$animate_onoffset = 'animate_onoffset';

	

	$transparency_markup = '';
	$transparency_class = '';
	if($transparency){
		$transparency_markup = '<span class="inner_shadow"></span><div class="transparency_bg"></div>';
		$transparency_class = 'transparency_section';
	}

	if($borders)
		$etxra_class .= ' borders ';

	if($cl_redata['fullscreen_sections_active'])
		$etxra_class .= ' section ';


    echo'<div id="'.uniqid("fws_").'" class="wpb_row vc_row-fluid '.esc_attr($transparency_class).' '.esc_attr($animate_onoffset).' row-dynamic-el '. esc_attr($main_class) . esc_attr($parallax_class) . ' ' . esc_attr($class) . ' ' . esc_attr($etxra_class).' " style="'.$style.'">';
    echo '<div '.( (!empty($class))?'id="'.$class.'"':'').' style="position: absolute;top: 0;"></div>';
	
    if($cl_redata['fullscreen_sections_active'])
    	echo '<div class="fullscreen_inner">';
	echo $transparency_markup;

   // echo $parallax_markup;

	if($type != 'full_width_content')

		$cl_class = 'container';

	else

		$cl_class = 'col span_12';

	echo $video_markup;

	echo $overlay_markup;

    echo '<div class="'.esc_attr($cl_class).' '.esc_attr($animate_onoffset_c).' '.strtolower($text_color).'">';

    	if($cl_class == 'container')
    		echo '<div class="section_clear">';
    	

    	echo wpb_js_remove_wpautop($content);

    	if($cl_class == 'container')
    		echo '</div>';
    	

    echo '</div>';

    if($cl_redata['fullscreen_sections_active'])
    	echo '</div>';

 echo '</div>';

?>