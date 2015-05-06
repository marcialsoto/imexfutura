<?php        
        global $cl_redata;
        extract(shortcode_atts(array(
            'title' => '',
            'icon_bool' => '',
            'style' => 'style_1',
            'icon' => '',
            'image' => '',
            'icon_color' => $cl_redata['primary_color'],
            'circle_color' => $cl_redata['highlighted_background_main'],
            'border_color' => $cl_redata['primary_color'],
            'dynamic_content_type' => '',
            'dynamic_post' => '',
            'dynamic_page' => '',
            'dynamic_content_link' => ''
        ), $atts));


        $output = '<div class=" services_medium '.esc_attr($style).' wpb_content_element">'; 

        $icon_class = (($icon_bool == 'yes')?'with_icon':'no_icon');
        
        $data = array();
        $query = array();

        $data['link'] = '';
        $data['description'] = '';

        if($dynamic_content_type == 'page'){
            $query = array( 'p' => $dynamic_page, 'posts_per_page'=>1, 'post_type'=> 'page' );
        }
        if($dynamic_content_type == 'post'){
            $query = array( 'p' => $dynamic_post, 'posts_per_page'=>1, 'post_type'=> 'post' );
        }
        if($dynamic_content_type == 'content'){
            $data['description'] = $content;
            $data['link'] = $dynamic_content_link;
        }else{
            $loop = new WP_Query($query);
            if($loop->have_posts()){
                while($loop->have_posts()){
                    $loop->the_post();
                    
                    $data['link'] = get_permalink();
                    $data['description'] = get_the_excerpt();
                    
                }
            }
            wp_reset_query();
        }

        
            
        if($icon_bool == 'icon' || $icon_bool == 'yes' && !empty($icon)):
            
            $extra_st = '';
            if($style == 'style_1')
                $extra_st = 'background:'.$circle_color.';';
            if($style == 'style_3')
                $extra_st = 'border:2px solid '.esc_attr($border_color).';';
            $output .= '<div class="icon_wrapper" style="'.$extra_st.'"><i class="'.esc_attr($icon).'" style="color:'.esc_attr($icon_color).';"></i></div>';
                

        endif;

        if($icon_bool == 'image' && !empty($image)):
            $output .= '<img src="'.esc_url(codeless_image_by_id($image, '', 'url')).'" alt="" />';
        endif;

        $output .= '<h4><a href="'.esc_url($data['link']).'">'.esc_html($title).'</a></h4>';
        $output .= '<p>'.do_shortcode($data['description']).'</p>';
        $output .= '</div>';
        echo $output;
?>