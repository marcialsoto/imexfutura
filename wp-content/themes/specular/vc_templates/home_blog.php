<?php
       extract(shortcode_atts(array(
            'style' => '',
            'posts_per_page' => '-1',
            'dynamic_from_where' => '',
            'dynamic_cat' => ''

        ), $atts));

        ob_start();

        if($dynamic_from_where == 'all')
          query_posts('posts_per_page = '.$posts_per_page );
        else
          query_posts('posts_per_page='.$posts_per_page.'&cat='.$dynamic_cat );
        

        global $for_element;
        $for_element = true;
        get_template_part( 'includes/view/blog/loop', $style);

        wp_reset_query();
        $output .= ob_get_clean();
        echo  $output;
?>