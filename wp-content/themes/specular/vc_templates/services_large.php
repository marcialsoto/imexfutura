<?php        
        extract(shortcode_atts(array(
            'title' => '',
            'icon' => '',
            'dynamic_content_type' => '',
            'dynamic_post' => '',
            'dynamic_page' => '',
            'dynamic_content_link' => ''
        ), $atts));


        $output = '<div class=" services_large wpb_content_element">';
        
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

        
            
        if(!empty($icon)):
               
            $output .= '<div class="icon_wrapper"><span class="top"></span><span class="left"></span><span class="right"></span><span class="bottom"></span><i class="'.esc_attr($icon).'"></i></div>';
                

        endif;

        $output .= '<h4><a href="'.esc_url($data['link']).'">'.esc_html($title).'</a></h4>';
        $output .= '<p>'.do_shortcode($data['description']).'</p>';
        $output .= '</div>';
        echo $output;
?>