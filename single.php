<?php
if(isset($_GET['export']) && $_GET['export'] == rss) $export = true;
else $export = false;
?>

<!DOCTYPE html>
<?php get_header(); ?>
<div class="content">
	
	<div class="coluna1">
		<? if (!$export): ?>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Coluna_1') ) : ?>
			<?php endif; ?>
		<? endif ?>
	</div><!--/coluna1-->
	<div class="middle">
		<h3><?php echo get_the_term_list( $post->ID, 'canal', '',' | ','' ); ?></h3>
		<div class="singlePost postPSI">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h2><?php the_title(); ?></h2>
				<div class="post_content">
					<?php the_content(); ?>
				</div>
				<div class="tags">
					<?php the_tags('Tags: ', ' | '); ?>
				</div>
				<!-- AddThis Button BEGIN 
					<div class="addthis_toolbox addthis_default_style ">
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_tweet"></a>
					<a class="addthis_counter addthis_pill_style"></a>
					</div>
					<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e16fd540bc4a059"></script>
				AddThis Button END -->
				<div class="byLine">
					Escrito por: <b><?php the_author() ?></b><br>
					Atualizado por: <b><?php the_modified_author(); ?> </b><br>
					<?php the_time('d.m.Y') ?> 	<?php the_time('H:i:s') ?> h			
				</div>
				<!--div class="disclaimer author<?php  the_author_meta(ID); ?>">
					Os pontos de vista expressos aqui são atribuídos ao autor deste blog, não necessariamente refletem a visão da BIREME.  
				</div-->
				<p class="back">
					<a href="javascript: history.back();">voltar</a>
				</p>

			<?php endwhile; else: ?>
			<!-- Mensagem caso ocorra um erro e o post não seja encontrado -->
				<p>O correu um erro</p>

			<?php endif; ?>
		</div>
		<div class="comments">
		<? if (!$export): ?>
			<?php comments_template(); ?> 
		<? endif ?>
		</div>
	</div><!--/middle-->
		<div class="coluna2">
			<? if (!$export): ?>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Coluna_2') ) : ?>
			<? endif ?>
			<?php endif; ?>
		</div><!--coluna2-->
	<div class="spacer"></div>
</div><!--/content-->
<?php get_footer(); ?>
