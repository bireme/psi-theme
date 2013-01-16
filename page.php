<!DOCTYPE html>
<?php get_header(); ?>
<div class="content">
	<div class="coluna1">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Coluna_1') ) : ?>
		<?php endif; ?>
	</div><!--/coluna1-->
	<div class="middle">
		<h3><?php echo get_the_term_list( $post->ID, 'canal' ); ?></h3>
		<div class="singlePost postPSI">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h2><?php the_title(); ?></h2>
				<div class="post_content">
					<?php the_content(); ?>
				</div>
				<div class="byLine">
					Escrito por: <b><?php the_author_posts_link() ?></b><br>
					Atualizado por: <b><?php the_modified_author(); ?> </b><br>
					<?php the_time('d.m.Y') ?> 	<?php the_time('H:i:s') ?> h			
				</div>
				<p class="back">
					<a href="javascript: history.back();">voltar</a>
				</p>

			<?php endwhile; else: ?>
			<!-- Mensagem caso ocorra um erro e o post não seja encontrado -->
				<p>O correu um erro</p>

			<?php endif; ?>
		</div>
	</div><!--/middle-->
	<div class="coluna2">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Coluna_2') ) : ?>
		<?php endif; ?>
	</div><!--coluna2-->
	<div class="spacer"></div>
</div><!--/content-->
<?php get_footer(); ?>
