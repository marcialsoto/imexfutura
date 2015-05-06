<?php

	

	extract(shortcode_atts(array(

            'slides' => '',

            'image_size' => ''

    ), $atts));



    $output = '<div class="slideshow wpb_content_element">';
        $slides = explode(',', $slides);
       
        $slides_ = array();

        if(count($slides) > 0):
            foreach($slides as $s):
                $slides_[] = array('attachment_id' => $s);
            endforeach;
        
            $slide = new codeless_slideshow(false, 'flexslider');
            $slide->slide_number = count($slides);
            $slide->img_size = $image_size;
            $slide->slides = $slides_;
            $output .= $slide->display();
        endif;

    $output .= '</div>';

    echo $output;
?>