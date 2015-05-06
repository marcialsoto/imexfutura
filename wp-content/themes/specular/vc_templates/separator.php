<?php

	extract(shortcode_atts(array(    

            'width' => '',

            'height' => '',

            'color' => '',

            'margin_top' => '',

            'margin_bottom' => '',

            'position' => ''

    ), $atts));

    $style = '';
    if($width != '')
        $style .= ' width:'.esc_attr($width).'; ';
    if($height != '')
        $style .= ' height:'.esc_attr($height).'; ';
    if($color != '')
        $style .= ' background:'.esc_attr($color).'; ';
    if($margin_top != '')
        $style .= ' margin-top:'.esc_attr($margin_top).'; ';
    if($margin_bottom != '')
        $style .= ' margin-bottom:'.esc_attr($margin_bottom).'; ';

    if($position == 'left') 
        $style .= ' float:left; ';

    if($position == 'right')
        $style .= ' float: right; ';

    if($position == 'center' && $width != ''){
        $style .= ' left:50%; margin-left: -'. ((int) substr($width, 0, -2) / 2 ).'px;position: relative;float: left; ';
    }
    $output = '<div class="codeless_separator"><span class="separator" style="'.$style.'"></span></div>';

    echo $output;
?>