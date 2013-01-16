<!DOCTYPE html>
<?php get_header(); ?>
<div class="content">
	<div class="coluna1">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Coluna_1') ) : ?>
		<?php endif; ?>
	</div><!--/coluna1-->
	<div class="middle">
		<div class="destaques">
			<h3>Destaques PSI</h3>
			<?php if(function_exists("insert_post_highlights")) insert_post_highlights(); ?>
		</div>
		<div class="post_Area">
			<?php query_posts( 'post_type=any&meta_key=primary_highlight&meta_value=1' ); ?>
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
						<?php 
							if (get_the_term_list( $post->ID, 'canal', true )) {
								$canal = get_the_term_list( $post->ID, 'canal', '[', '] [', ']' );
								echo '<span class="canal">'.$canal.'</span>';
							}
						?>
					</div><!--/post-ID-->					
					<div class="spacer"></div>
				</div><!--/post-->
			<?php endwhile; else: ?>
			<p><?php _e(''); ?></p>
			<?php endif; ?>
			<?php wp_reset_query();?>
		</div><!--/posts-->
		<div class="destaques_secundarios">
			<?php query_posts( 'post_type=any&meta_key=highlight_home&meta_value=1' ); ?>
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
		</div><!--/destaques_secundarios-->
	</div><!--/middle-->
	<div class="coluna2">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Coluna_2') ) : ?>
		<?php endif; ?>
	</div><!--coluna2-->
	<div class="spacer"></div>
</div><!--/content-->
<?php get_footer(); ?>
