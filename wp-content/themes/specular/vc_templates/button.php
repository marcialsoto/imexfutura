<?php
global $cl_redata;
extract(shortcode_atts(array(

    'title' => '',

    'link' => '',

    'icon' => '',

    'align' => 'left'

), $atts)); 


$output = '<div class="wpb_content_element button">';
    
    $output .= '<a class="btn-bt align-'.esc_attr($align).' '.esc_attr($cl_redata['overall_button_style'][0]).'" href="'.esc_url($link).'"><span>'.esc_attr($title).'</span><i class="'.esc_attr($icon).'"></i></a>';

$output .= '</div>';

echo  $output;

?>