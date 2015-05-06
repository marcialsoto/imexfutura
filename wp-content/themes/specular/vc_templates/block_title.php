<?php

extract(shortcode_atts(array(

    'title' => '',

    'style' => '',

    'inner_style' => 'simple',

    'second_title' => '',

    'padding_desc' => '28%',

    'description' => '',

    'inner_style_title' => 'square'

), $atts)); 

if($style == 'section_title')
    $inner_style = $inner_style_title;

$output = '<div class="wpb_content_element block_title '.esc_attr($style).' inner-'.esc_attr($inner_style).' ">';
    if(!empty($title))
        $output .= '<h1>'.esc_html($title).'</h1>';
    if($style == 'column_title' && !empty($second_title))
        $output .= '<h2>'.esc_html($second_title).'</h2>';
    if($style == 'section_title'){
        if(!empty($title) && $inner_style_title == 'square' )
            $output .= '<span class="divider"><span class="line"></span><span class="circle"></span><span class="line"></span></span>';
        if(!empty($description))
            $output .= '<p style="padding:0 '.esc_attr($padding_desc).';">'.$description.'</p>';
    }

$output .= '</div>';

echo  $output;

?>