<?php



		extract(shortcode_atts(array(

            'year' => '',

            'month' => '',

            'day' => ''

        ), $atts)); 

		$output = '<div class="wpb_content_element countdown">';

        

        $output .= '<div id="countdowndiv"></div>';

	 	$output .= "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";

    	$output .= 'jQuery(document).ready(function($){$("#countdowndiv").countdown({until: new Date('.esc_js($year).', '.esc_js(($month-1)).', '.esc_js($day).')})} );';

    	$output .= "</script>\n \n ";

 

         

        $output .= '</div>';

        echo $output; 

?>