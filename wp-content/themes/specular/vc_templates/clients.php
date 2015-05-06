<?php

	global $cl_redata;

	extract(shortcode_atts(array(    

            'title' => '',

            'carousel' => '',

            'dark_light' => ''

    ), $atts));

	if(!isset($carousel))
        $carousel = 'no';

    $clients = array();

    if($dark_light == 'dark')
        $clients = $cl_redata['clients_dark'];
    else
        $clients = $cl_redata['clients_light'];


    $output = '<div class="'.esc_attr($dark_light).'_clients clients_el">';
        
        $output .= '<div class="pagination"><a href="#" class="prev"><i class="icon-chevron-left"></i></a><a href="#" class="next"><i class="icon-chevron-right"></i></a></div>';

        $output .= '<section class="row clients '.(($carousel=="yes")?"clients_caro":"").'">';

                    foreach($clients as $client):                            

                            $output .= '<div class="item">';

                                $output .= '<a href="'.esc_url($client['url']).'" title="'.esc_attr($client['title']).'">';

                                $output .= wp_get_attachment_image( $client['attachment_id'], 'full' );

                                $output .= '</a>';

                            $output .= '</div>';

                    endforeach;

        $output .= '</section>';

    $output .= '</div>';

    echo $output;
?>