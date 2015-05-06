<?php
		
		extract(shortcode_atts(array(
            'dynamic_src' => '',
            'height' => '',
            'desc' => ''
        ), $atts)); 
		$output = '<div class="wpb_content_element">';  
        $extra_class='';
        $position = 'relative';
       
        $output .= '<div class="row-fluid row-google-map " style="position:'.$position.'; height:'.esc_attr($height).'px;"><iframe class="googlemap '.$extra_class.'" style="height:'.$height.'px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.esc_url($dynamic_src).'&amp;output=embed"></iframe><div class="desc">'.$desc.'</div>';
        
        $output .= '</div>';
        
        $output .= '</div>';
        echo  $output;

?>