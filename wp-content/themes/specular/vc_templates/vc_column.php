<?php
$output = $el_class = $width = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'width' => '1/1',
    "centered_cont" => 'false',
    'centered_cont_vertical' => 'false',
    'animation' => '', 
    'column_padding' => 'no-pad',
    'delay' => '0',
    'background_color' => '',
    'background_color_opacity' => '',
    'background_image' => '',
    'font_color' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);
$extra_style = '';
$el_class .= ' wpb_column column_container';

if($centered_cont == 'true') 
	$el_class .= ' centered_col';

if($centered_cont_vertical == 'true')
	$el_class .= ' centered_vertical';

if(!empty($background_image) && !empty($background_color) )
	$el_class .= ' with_overlay';

$overlay_style = '';
if(!empty($background_color)) {
	if($background_color_opacity != '1'){ 
		if(strpos($background_color, '#') == 0){ 
			$rgba_color = vc_hex2rgb($background_color); 

			$overlay_style .= ' background-color: rgba('.$rgba_color[0].','.$rgba_color[1].','.$rgba_color[2].','.$background_color_opacity.'); ';
		}else
			$overlay_style .= ' background-color: '.$background_color.';';
			
	} else {
		$overlay_style .= ' background-color: '.$background_color.'; ';	
	} 
}
$extra_style .= $overlay_style;
if(!empty($background_image)) { 
	$bg_image_src = wp_get_attachment_image_src($background_image, 'full');
	$extra_style .= ' background-image: url(\''.esc_url($bg_image_src[0]).'\'); ';
}
if(!empty($font_color)) 
	$extra_style .= ' color: '.$font_color.';';

if(!empty($background_image))
	$el_class .= ' using_bg';

if($column_padding != 'no-pad'){
	$el_class .= ' with_padding';
	$extra_style .= 'padding:'.$column_padding;
}

if(!empty($animation) && $animation != 'none') {
	 $el_class .= ' with_animation animated';
	 $delay = intval($delay);
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);
$output .= "\n\t".'<div class="'.$css_class.'" style="'.$extra_style.'" data-animation="'.esc_attr($animation).'" data-delay="'.esc_attr($delay).'">';
if(!empty($background_image) && !empty($background_color) )
	$output .= "\n\r".'<div class="overlay" style="'.$overlay_style.'"></div>';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output; 