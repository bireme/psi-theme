<!DOCTYPE html>
<?php get_header(); ?>
<div class="content">
	<div class="coluna1">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Coluna_1') ) : ?>
		<?php endif; ?>
	</div><!--/coluna1-->
	<div class="middle">
		<h3>Post's marcados com a tag: <?php
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
						<span class="canal">[<?php echo get_the_term_list( $post->ID, 'canal' ); ?>]</span>
					</div><!--/post-ID-->					
					<div class="spacer"></div>
				</div><!--/post-->
			<?php endwhile; else: ?>
			<p><?php _e(''); ?></p>
			<?php endif; ?>
		</div><!--/post_Area-->
	</div><!--/middle-->
	<div class="coluna2">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Coluna_2') ) : ?>
		<?php endif; ?>
	</div><!--coluna2-->
	<div class="spacer"></div>
</div><!--/content-->
<?php get_footer(); ?>
