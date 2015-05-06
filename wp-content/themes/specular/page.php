<?php
 
global $cl_redata, $cl_current_view;
do_action( 'codeless_routing_template' , 'page' );
$cl_current_view = 'page';

$id = codeless_get_post_id(); 
$replaced = redux_post_meta('cl_redata',(int) $id);

if(!empty($replaced))
    foreach($replaced as $key => $value){
        $cl_redata[$key] = $value;
    }

if($cl_redata['layout'] == 'fullwidth')
    $spancontent = 12;
 else
    $spancontent = 9;


get_header();

get_template_part('includes/view/page_header'); ?>

<?php if(!$cl_redata['fullscreen_sections_active']): ?>    
    
<section id="content" class="composer_content" style="background-color:<?php echo (!empty($cl_redata['page_content_background']))?esc_attr($cl_redata['page_content_background']):'#ffffff'; ?>;">
        <?php if($spancontent != 12 || !is_vc()){ ?>
        <div class="container <?php  echo esc_attr($cl_redata['layout']) ?>" id="blog">
            <div class="row">
            <?php if($cl_redata['layout'] == 'sidebar_left') get_sidebar(); ?>   
                <div class="span<?php echo $spancontent ?>">
                    
                    <?php get_template_part( 'includes/view/loop', 'page' ); ?>

                </div>
                <?php
                
                wp_reset_query();    
    
                if($cl_redata['layout'] == 'sidebar_right') get_sidebar(); 

                ?>

            </div>
        </div>
        <?php }else{ ?>

            <?php get_template_part( 'includes/view/loop', 'page' ); wp_reset_query(); ?>            
             
        <?php } ?>

</section>

<?php else: ?>
    
    <div id="fullpage">
        <?php get_template_part( 'includes/view/loop', 'page' ); wp_reset_query(); ?>
    </div>

<?php endif; ?>


<?php get_footer(); ?>