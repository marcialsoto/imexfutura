<?php        
        extract(shortcode_atts(array(
            'title' => '',
            'icon' => ''
        ), $atts));


        $output = '<div class=" services_steps wpb_content_element">';
            
        if(!empty($icon)):
               
            $output .= '<div class="icon_wrapper"><i class="'.esc_attr($icon).'"></i></div>';

        endif;
            $output .= '<div class="content">';
                $output .= '<h4>'.esc_html($title).'</h4>';
                $output .= '<p>'.do_shortcode($content).'</p>';
            $output .= '</div>';
        $output .= '</div>';
        echo $output;
?>