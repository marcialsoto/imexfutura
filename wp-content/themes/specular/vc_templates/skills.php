<?php
		
		extract(shortcode_atts(array(
            'title' => '',
            'desc' => ''
        ), $atts)); 
        
       

		$output = '<div class="wpb_content_element block_skill">';
        
        if(!empty($title)){
         	$output .= '<div class="header"><h3>'.esc_html($title).'</h3></div>';      
        }

        if(!empty($desc))
        	$output .= '<p>'.$desc.'</p>';

        $output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);

        $output .= '</div>';
        echo  $output;


?>