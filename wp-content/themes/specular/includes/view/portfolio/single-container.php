<?php

global $cl_redata;
do_action('codeless_excecute_query_var_action','loop-single_portfolio_bottom');

?>

<div class="container">
    

    <?php if($cl_redata['single_portfolio_content_position_container'] != 'bottom'): ?>
    <div class="row-fluid">
            
        <?php if($cl_redata['single_portfolio_content_position_container'] == 'left'): ?>
            <div class="span3">
                <div class="description">
                    <h4><?php _e('Project Description', 'codeless') ?> hola</h4>
                    <?php the_content(); ?>
                </div>
                <div class="details">
                    <h4><?php _e('Project Details', 'codeless') ?></h4>

                    <ul class="info">
                        <?php if(!empty($cl_redata['single_portfolio_custom_params']) ): for($i = 0; $i < count($cl_redata['single_portfolio_custom_params']); $i++): ?>
                            <?php if(isset($cl_redata['single_portfolio_custom_fields'][$i]) && !empty($cl_redata['single_portfolio_custom_fields'][$i]) ): ?>
                                <li><span class="title"><?php echo esc_attr($cl_redata['single_portfolio_custom_params'][$i]) ?></span><span><?php echo esc_attr($cl_redata['single_portfolio_custom_fields'][$i]) ?></span></li>
                            <?php endif; ?>
                        <?php endfor;  endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?> 

        <div class="span9">
            <div class="media">
                
                <?php if($cl_redata['single_portfolio_media'] == 'featured'): ?>
                    <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), '', 'url'))  ?>" alt="">
                <?php endif; ?>
                <?php 
                    if($cl_redata['single_portfolio_media'] == 'slideshow'): 
                        $slider = new codeless_slideshow(get_the_ID(), 'flexslider');
                            $slider->slides = $cl_redata['single_portfolio_gallery'];
                            $slider->slide_number = count($cl_redata['single_portfolio_gallery']);
                            if($slider && $slider->slide_number > 0){  
                                $slider->img_size = '';
                                $sliderHtml = $slider->render_slideshow();
                                echo $sliderHtml;
                            }
                    endif; 
                ?>
                <?php 
                    if($cl_redata['single_portfolio_media'] == 'video'){
                            $video = ""; 

                            if(codeless_backend_is_file( $cl_redata['single_portfolio_video'], 'html5video')){

                                $video = codeless_html5_video_embed($cl_redata['single_portfolio_video']);

                            }
                            else if(strpos($cl_redata['single_portfolio_video'],'<iframe') !== false)
                            {
                                $video = $cl_redata['single_portfolio_video'];
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($cl_redata['single_portfolio_video'])."[/embed]");
                            }

                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.esc_url($cl_redata['single_portfolio_video']).'"></iframe>';
                            } 

                            echo $video;               
                    }
                ?>
            </div>
        </div>

        <?php if($cl_redata['single_portfolio_content_position_container'] == 'right'): ?>
            <div class="span3">
                <div class="description">
                <?php $terms = get_the_terms( $post->ID, 'portfolio_entries' ); 
					foreach ( $terms as $term ) { $term_links[] = $term->term_id; } 
					
				?>
                
				<?php if ($term_links[0] == 39 ): ?>             
                <div class="details">
                <dl>
                  
                  <dt>Nombre Científico</dt>
                  <dd><?php the_field('nombre_cientifico'); ?></dd> 
                  
                  <dt>Clase</dt>
                  <dd><?php the_field('clase'); ?></dd>
                  
                  <dt>Partida Arancelaria</dt>
                  <dd><?php the_field('partida_arancelaria'); ?></dd>
                  
                  <dt>Presentación</dt>
                  <dd><?php the_field('presentacion'); ?></dd>
                  
                  <dt>Etiqueta Privada</dt>
                  <dd><?php the_field('etiqueta_privada'); ?></dd>
                  
                
                  
                </dl>
                </div>

                <?php elseif ($term_links[0] == 40 ): ?>
                  <div class="details">
                <dl>             
                  <dt>Empaque</dt>
                  <dd><?php the_field('empaque'); ?></dd>
                  
                  <dt>Caja Máster</dt>
                  <dd><?php the_field('caja_master'); ?></dd>
                  
                  <dt>Presentación</dt>
                  <dd><?php the_field('presentacion'); ?></dd>
                  
                  <dt>Tiempo de Vida</dt>
                  <dd><?php the_field('tiempo_de_vida'); ?></dd>
                  
                  <dt>Partida Arancelaria</dt>
                  <dd><?php the_field('partida_arancelaria'); ?></dd>
                  
                </dl>
                </div>
                <?php elseif ($term_links[0] == 69 ): ?>
                <div class="details">
                <dl>
                  
                  <dt>Descripción del Producto</dt>
                  <dd><?php the_content(); ?></dd>
                  
                  <dt>Composición</dt>
                  <dd><?php the_field('partida_arancelaria'); ?></dd>
                  
                  <dt>Presentación</dt>
                  <dd><?php the_field('presentacion'); ?></dd>
                  
                  <dt>Vida Util</dt>
                  <dd><?php the_field('vida_util'); ?></dd>
                  
                </dl>
                </div>
                <?php else : ?>
                <div class="details">
                <dl>
                  
                  <dt>Descripción del Producto</dt>
                  <dd><?php the_content(); ?></dd>
                </dl>
                </div>
				<?php endif; ?> 
				</div>
                
              <?php /*?>    <div class="details">
                  <h4><?php _e('Project Details', 'codeless') ?></h4>

                    <ul class="info">
                        <?php if(!empty($cl_redata['single_portfolio_custom_params']) ): for($i = 0; $i < count($cl_redata['single_portfolio_custom_params']); $i++): ?>
                            <?php if(isset($cl_redata['single_portfolio_custom_fields'][$i]) && !empty($cl_redata['single_portfolio_custom_fields'][$i]) ): ?>
                                <li><span class="title"><?php echo esc_attr($cl_redata['single_portfolio_custom_params'][$i]) ?></span><span><?php echo esc_attr($cl_redata['single_portfolio_custom_fields'][$i]) ?></span></li>
                            <?php endif; ?>
                        <?php endfor;  endif; ?>
                    </ul>
                </div><?php */?>
            </div>
        <?php endif; ?> 
    </div>
    <?php endif; ?>
    <div class="row">
			<div class="span6">
                <dl>
	              <dt>Descripción Comercial</dt>
                  <dd><?php the_content(); ?></dd>
                </dl>
            </div>
            <?php if ($term_links[0] == 39 || $term_links[0] == 69 ){ ?>  
            	<div class="span6">
                <dl>
	              <dt>Especificaciones Técnicas</dt>
                  <dd><?php the_field('especificaciones_tecnicas'); ?></dd>
                </dl>
            </div>
            <?php } ?>
	</div>
    <?php if($cl_redata['single_portfolio_content_position_container'] == 'bottom'): ?>
    <div class="media">
        <?php if($cl_redata['single_portfolio_media'] == 'featured'): ?>
            <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), '', 'url'))  ?>" alt="">
        <?php endif; ?>
        <?php 
            if($cl_redata['single_portfolio_media'] == 'slideshow'): 
                $slider = new codeless_slideshow(get_the_ID(), 'flexslider');
                    $slider->slides = $cl_redata['single_portfolio_gallery'];
                    $slider->slide_number = count($cl_redata['single_portfolio_gallery']);
                    if($slider && $slider->slide_number > 0){  
                        $slider->img_size = 'blog';
                        $sliderHtml = $slider->render_slideshow();
                        echo $sliderHtml;
                    }
            endif; 
        ?>
        <?php 
                    if($cl_redata['single_portfolio_media'] == 'video'){
                            $video = ""; 

                            if(codeless_backend_is_file( $cl_redata['single_portfolio_video'], 'html5video')){

                                $video = codeless_html5_video_embed($cl_redata['single_portfolio_video']);

                            }
                            else if(strpos($cl_redata['single_portfolio_video'],'<iframe') !== false)
                            {
                                $video = $cl_redata['single_portfolio_video'];
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($cl_redata['single_portfolio_video'])."[/embed]");
                            }

                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.esc_url($cl_redata['single_portfolio_video']).'"></iframe>';
                            } 

                            echo $video;               
                    }
        ?>

    </div>
    <div class="row-fluid content"> 
        <div class="span9">
            <h4><?php _e('Project Description', 'codeless') ?></h4>
            <?php the_content(); ?>
        </div>
        <div class="span3">
            <h4><?php _e('Project Details', 'codeless') ?></h4>

            <ul class="info">
                <?php if(!empty($cl_redata['single_portfolio_custom_params']) ): for($i = 0; $i < count($cl_redata['single_portfolio_custom_params']); $i++): ?>
                    <?php if(isset($cl_redata['single_portfolio_custom_fields'][$i]) && !empty($cl_redata['single_portfolio_custom_fields'][$i]) ): ?>
                        <li><span class="title"><?php echo esc_attr($cl_redata['single_portfolio_custom_params'][$i]) ?></span><span><?php echo esc_attr($cl_redata['single_portfolio_custom_fields'][$i]) ?></span></li>
                    <?php endif; ?>
                <?php endfor;  endif; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>

    <?php if($cl_redata['single_portfolio_active_comments']) comments_template( '/includes/view/blog/comments.php');  ?>
</div>