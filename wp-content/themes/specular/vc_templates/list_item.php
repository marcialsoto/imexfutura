<?php
	
		extract(shortcode_atts(array(
            'title' => '',
            'desc' => '',
            'style' => ''
        ), $atts)); 

        $output = '<li class="'.esc_attr($style).'">';
        	if($style == 'simple'){
        		$output .= '<i class=""></i>';
        		$output .= esc_html($title);
        	}else{
        		$output .= '<dl class="dl-horizontal">';
        			$output .= '<dt><span class="circle"><i class=""></i></span></dt>';
        			$output .= '<dd><h6>'.esc_html($title).'</h6><p>'.$desc.'</p></dd>';
        		$output .= '</dl>';
        	}
        	
        $output .= '</li>';

        echo $output;

?>