<!DOCTYPE html>
<?php get_header(); ?>
<div class="content">
	<div class="coluna1">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Coluna_1') ) : ?>
		<?php endif; ?>
	</div><!--/coluna1-->
	<div class="middle">
		<h3><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 */
			global $page, $paged;
		
			wp_title( '', true, 'right' );
		
			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";
		
			// Add a page number if necessary:
			if ( $paged >= 2 || $page >= 2 )
				echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></h3>
		<div class="post_Area">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php $is_post_highlight = get_post_meta($post->ID, 'highlight_channel', true); ?>
				
				<?php if (  !$is_post_highlight ) :  // exclude post highlight_channel from loop ?>
				
				<div class="post" id="call-<?php the_ID(); ?>">
					<div class="post_<?php the_ID(); ?> post_content">
						<span class="category_name"><?php the_category(', '); ?></span>
						<h3 class="post_title">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>
						</h3>
						<div class="authorLine">Publicado em: <?php the_time('d/m/Y') ?> | Escrito por: <?php the_author_posts_link() ?></div>
						<div class="thumb">
							<?php
							//verifica se existe algum thumbnail para o post
							if(has_post_thumbnail()){
								the_post_thumbnail(); //retorna o thumbnail para página
							//caso não tenha nenhuma thumbnail, retorna uma imagem padrão
							}else{
								echo '<img src="'.get_bloginfo("template_url").'/images/default_thumb.jpg" alt="Sem Thumbnail" title="Sem Thumbnail" />';
							}
							?>
						</div><!--/thumb-->
						<div class="call">
							<?php the_excerpt(); ?>
						</div><!--/call-->
						<?php 
							if (get_the_term_list( $post->ID, 'canal', true )) {
								$canal = get_the_term_list( $post->ID, 'canal', '[', '] [', ']' );
								echo '<span class="canal">'.$canal.'</span>';
							}
						?>
					</div><!--/post-ID-->					
					<div class="spacer"></div>
				</div><!--/post-->
				
				<?php endif; // if post_highlight ?> 				
				
			<?php endwhile?>
				<?php if(function_exists('wp_paginate')) {
				    wp_paginate();
				} ?>
			<?php else: ?>
			<p><?php _e(''); ?></p>
			<?php endif; ?>
		</div><!--/post_Area-->
		<div class="destaques_secundarios">
			<?php
				if (is_category()) {
					$cat = get_query_var('cat');
					$current_cat = get_category($cat);
					query_posts( 'post_type=any&meta_key=highlight_channel&meta_value=1&category_name='.$current_cat->slug.'' ); 
				}
				if (is_tax()) {
					$term =	$wp_query->queried_object;
					$wpq = array ('meta_key' => 'highlight_channel','meta_value' => 1, 'taxonomy'=>'canal', 'term' => $term->name);
					query_posts( $wpq );
					//$query = new WP_Query ($wpq);
				}
				
			?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="feature_2level">
						<span class="category_name"><?php the_category(', '); ?></span><br>
						<span class="call_title">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>
						</span>
						<?php 
							if (get_the_term_list( $post->ID, 'canal', true )) {
								$canal = get_the_term_list( $post->ID, 'canal', '[', '] [', ']' );
								echo '<span class="canal">'.$canal.'</span>';
							}
						?>
					</div>
			<?php endwhile; endif; ?>
			<?php wp_reset_query();?>
		</div><!--/destaques_secundarios-->
	</div><!--/middle-->
	<div class="coluna2">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Coluna_2') ) : ?>
		<?php endif; ?>
	</div><!--coluna2-->
	<div class="spacer"></div>
</div><!--/content-->
<?php get_footer(); ?>
