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
		<div class="post_Area authorsList">
			<ul class="usersBlogList">
				<?php
					echo '<ul>';
				    function activeAuthors() {
				    global $wpdb;
				 
				 	//query que busca o ID de todos os usuarios do blog exceto o admin
				    $authors = $wpdb->get_results("SELECT ID from $wpdb->users WHERE display_name <> 'admin' ORDER BY display_name");
				 	
					foreach($authors as $author) {
						//Busca dados do usuário de acordo com seu ID
						$user_info = get_userdata($author->ID);
						//Faz a checagem de quantos posts cada um publicou
						$post_count = get_usernumposts($author->ID);
						//Checagem se o usuário é mais que assinante e tem ao menos 1 post ele é listado caso contrário não
						if (($user_info->user_level >= 1) && ($post_count >= 1)) {
						      echo '<li class="author_List">';
							  echo userphoto_thumbnail($author->ID);
							  echo '<div class="authorInfo">';
							  echo '<span class="authorName"><a href=';
							  echo bloginfo( 'url' ) . '/author/' . $user_info->user_login;
						      echo '>' . $user_info->display_name . '</a></span>';
							  echo '<div class="rss"><a href=';
							  echo bloginfo( 'url' ) . '/author/' . $user_info->user_login . '/feed';
							  echo '><span>RSS</span></a></div>';
						      echo '<span class="userDescription">' . $user_info->user_description . '</span>';
						      echo '<span class="numPosts">' . $post_count . ' Posts publicados</span>';
							  echo '</div><div class="spacer"></div>';
							  echo '</li>';
						}
	
				    }
				    }
				?>
			
				<!-- chamada para a função -->
				<?php activeAuthors(); ?>
			</ul>
		</div><!--/post_Area-->
	</div><!--/middle-->
	<div class="coluna2">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Coluna_2') ) : ?>
		<?php endif; ?>
	</div><!--coluna2-->
	<div class="spacer"></div>
</div><!--/content-->
<?php get_footer(); ?>
