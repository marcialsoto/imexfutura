<?php
        global $cl_redata;

		extract(shortcode_atts(array(

    	), $atts));

		$output = ''; 

        $output = '<div class="wpb_content_element testimonial_cycle_element">';

        $output .= '<section class="testimonial_cycle">';      

        $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'testimonial' );                          

        $loop = new WP_Query($query_post);

        if($loop->have_posts()){

            while($loop->have_posts()){

                $loop->the_post();  

                            $output .= '<div class="item">';

                                $output .= '<p>'.get_the_content().'</p>';

                                $output .= '<div class="param">';

                                $output .= '<i class="moon-user"></i>';

                                $output .= '<div class="name"><h6>'.esc_html(get_the_title()).', </h6><span class="position"> '.esc_attr($cl_redata['staff_position']).'</span></div>';

                                $output .= '</div>';

                            $output .= '</div>';
            }

        }

        wp_reset_query();

        $output .= '</section>';

        $output .= '</div>';

        echo $output;

?>