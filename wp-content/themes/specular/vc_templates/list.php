<?php
		
		extract(shortcode_atts(array(
            'icon' => ''
        ), $atts)); 

        $output = '<div class="wpb_content_element list" style="">';       

            $output .= '<ul data-icon="'.esc_attr($icon).'">';
                $output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);
            $output .= '</ul>';

        $output .= '</div>';

        echo $output;

?>