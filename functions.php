<?php
if ( function_exists('register_sidebar') )
	register_sidebar(array('name'=>'Coluna_1', 
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '',
	        'after_title' => '',
	    ));
	register_sidebar(array('name'=>'middle', 
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2>',
	        'after_title' => '<h2>',
	    ));
	register_sidebar(array('name'=>'Coluna_2', 
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<span class="title_widget">',
	        'after_title' => '</span>',
	    ));
    if (function_exists('add_theme_support')) {
        add_theme_support('post-thumbnails');
		set_post_thumbnail_size(170, 99999);
        add_image_size('mini_thumb', 220, 150, true);
        add_image_size('feature', 300, 200, true);
        add_image_size('tv', 300, 99999);
	}		
     function the_category_filter($thelist,$separator=' ') {
	if(!defined('WP_ADMIN')) {
	//list the category names to exclude
	$exclude = array('Sem categoria', 'TV');
	$cats = explode($separator,$thelist);
	$newlist = array();
	foreach($cats as $cat) {
	$catname = trim(strip_tags($cat));
	if(!in_array($catname,$exclude))
	$newlist[] = $cat;
	}
	return implode($separator,$newlist);
	} else
	return $thelist;
	}
	add_filter('the_category','the_category_filter',10,2);
?>