<?php

		extract(shortcode_atts(array(

            'title' => '',

            'percentage' => '',

            'color' => ''

        ), $atts)); 



		/*if(!isset($skill['color']))

            $color = 'base';

        */

        if($color == 'base'){

            $color = $base;
        }    

        $output .= '<h6 class="skill_title">'.esc_html($title).'</h6><span class="big_percentage">'.$percentage.'%</span>';

        $output .= '<div class="skill animate_onoffset" data-percentage="'.esc_attr($percentage).'">';

 		$output .= '<div class="prog" style="width:0%; background:'.esc_attr($color).';"><span class="circle"></span></div>';

    	$output .= '</div>'; 

    	echo $output;

?>