<?php
        global $cl_redata;

		extract(shortcode_atts(array(

    	), $atts));

		$output = ''; 

        $output = '<div class="wpb_content_element testimonial_carousel_element">';

            $output .= '<div class="pagination"><a href="#" class="prev"><i class="icon-chevron-left"></i></a><a href="#" class="next"><i class="icon-chevron-right"></i></a></div>';

            $output .= '<section class="row testimonial_carousel">';      

        $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'testimonial' );                          

        $loop = new WP_Query($query_post);

        if($loop->have_posts()){

            while($loop->have_posts()){

                $loop->the_post();  

                            $output .= '<div class="item">';

                                $output .= '<p>'.get_the_content().'</p>';

                                $output .= '<div class="param">';

                                $output .= '<h6>'.esc_html(get_the_title()).', </h6><span class="position"> '.esc_attr($cl_redata['staff_position']).'</span>';

                                $output .= '</div>';

                            $output .= '</div>';
            }

        }

        wp_reset_query();

            $output .= '</section>';

        $output .= '</div>';

        echo $output;

?>