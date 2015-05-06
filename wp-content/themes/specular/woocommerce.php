<?php

global $cl_redata, $cl_current_view;

$id = codeless_get_post_id(); 
$replaced = redux_post_meta('cl_redata',(int) $id);

if(!empty($replaced))
    foreach($replaced as $key => $value){
        $cl_redata[$key] = $value;
    }

do_action( 'codeless_routing_template' , 'page' );
$cl_current_view = 'woocommerce';
if($cl_redata['layout'] == 'fullwidth')
    $spancontent = 12;
 else
    $spancontent = 9;


get_header(); 

get_template_part('includes/view/page_header'); ?>
        
<?php if($spancontent != 12) $extra_class .= ' with_sidebar'; ?>
<section id="content" class="composer_content <?php echo esc_attr($extra_class) ?>" style="background-color:<?php echo (!empty($cl_redata['page_content_background']))?esc_attr($cl_redata['page_content_background']):'#ffffff'; ?>;">
        <div class="container <?php  echo $cl_redata['layout'] ?>" id="blog">
            <div class="row">
            <?php if($cl_redata['layout'] == 'sidebar_left') get_sidebar(); ?>   
                <div class="span<?php echo esc_attr($spancontent) ?>">
                    
                    <?php woocommerce_content() ?> 

                </div>
                <?php
                
                wp_reset_query();    
    
                if($cl_redata['layout'] == 'sidebar_right') get_sidebar(); 

                ?>

            </div>
        </div>
</section>

<?php get_footer(); ?>