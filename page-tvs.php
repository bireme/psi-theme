<?php
// time in seconds
$TIME_PER_POST = 15;

$posts = get_posts('post_type=any&meta_key=tv_checkbox&meta_value=1&posts_per_page=-1');

//die(count($posts));

$total_posts = 0;
$show_posts = array();
foreach($posts as $post) {
	$now = date("Ymd");
	settype($now,"int");

	$meta = @get_post_meta($post->ID);
	if(array_key_exists('tv_checkbox', $meta) && $meta['tv_checkbox'][0] == 0) {
		continue;
	}
	if(array_key_exists('tv_start_date', $meta)) {
		$start_date = str_replace("-","",$meta['tv_start_date'][0]); 
		settype($start_date,"int");
		if ($now < $start_date && $start_date != 0)
			continue;
	}
	if(array_key_exists('tv_end_date', $meta)) {
		$final_date = str_replace("-","",$meta['tv_end_date'][0]); 
		settype($final_date,"int");
		if ($now > $final_date && $final_date != 0)
			continue;
	} 
	$show_posts[] = $post;
	$total_posts++;
}
$total_time = $total_posts*$TIME_PER_POST;

/* função que cria o automatic_excerpt, que não foi encontrado
   na nova estrutura de exibição de posts */
/*function automatic_excerpt($content) {

	$WORDS_LENGHT = 55;

	$content = preg_replace('/\[\/?.*\]/','', $content);
	$content = strip_tags($content);
	$content = explode(" ", $content);

	$excerpt = "";
	for($i=0; $i<$WORDS_LENGHT; $i++) {
		$excerpt .= $content[$i] . " ";
	}
	
	if (count($content) > $WORD_LENGHT) {
		return $excerpt . "[...]";			
	} else {
		return $excerpt;
	}
}*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<!--
	Supersized - Fullscreen Background jQuery Plugin
	Version 3.1.3 Core
	www.buildinternet.com/project/supersized
	
	By Sam Dunn / One Mighty Roar (www.onemightyroar.com)
	Released under MIT License / GPL License
	-->
	<head>
		<title>TV - Boletim PSI - BIREME | OPAS | OMS</title>
		<meta http-equiv="refresh" content="<?=$total_time+5 ?>">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
		<!-- SUPERSIZED-->
			<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/page-tv/css/supersized.core.css" type="text/css" media="screen" />
			<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/page-tv/js/jquery.min.js"></script>
			<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/page-tv/js/supersized.3.1.3.core.min.js"></script>
			<script type="text/javascript">  
				jQuery(function($){
					$.supersized({
						slides	:  [ { image : '<?php bloginfo( 'template_directory' ); ?>/page-tv/16x9.jpg' } ]					
					});
				});
			</script>
		<!--/SUPERSIZED -->
		<!--CAROUSEL-->
			<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/page-tv/js_carousel/jquery.min.js"></script>
			<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/page-tv/js_carousel/unobtrusivelib.js"></script>
			<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/page-tv/js_carousel/prettify.js"></script>
			<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/page-tv/js_carousel/jquery.carousel.pack.js"></script>
			<script type="text/javascript">
				$(function(){
					$.unobtrusivelib();
					prettyPrint();
					$("div.destaques_tv").carousel({ pagination: true, autoSlide: true, loop: true, autoSlideInterval: <?=$TIME_PER_POST*1000?>, effect: "fade"});
				});
			</script>
		<!--/CAROUSEL-->
		<script>
			document.write("<style>.destaques_tv li { width: " + screen.width + "px;}</style>");
			document.write("<style>body { font-size: " + screen.width + "px;}</style>");
		</script>
		<style type="text/css">
			body {
				font-family: Arial, Helvetica, sans-serif;
			}
			body, h1, h2, h3, h4, h5 {
				margin: 0px;
				padding: 0px;
			}
			.destaques_tv {
				top: 17%;
				position: absolute;
				width: 100%;
			}
			.destaques_tv li {
				float: left;
				list-style: none;
			}
			
			.destaques_tv ul {
				margin: 0px;
				padding: 0px;
			}
			
			.carousel-control, .carousel-pagination {
				display: none;
			}
			
			.coluna01 {
				float: left;
				width: 90%;
				margin: 0px 5%;
				min-height: 450px;
			}
			.coluna01 .thumb {
				float: right;
				margin: 0px 0px 5% 5%;
			}
			.title {
				clear: both;
			}		
			.title h1 {
				margin: 0px 5% 40px 5%;
				font-size: 42px;
			}
			
			.chamada {
				font-size: 2%;
				line-height: 150%;
			}
			
			.date {
				text-align: right;
				display: block;
				width: 100%;
				position: absolute;
				bottom: 50px;
				font-size: 1.75%;
			}
			
			.date span {
				margin: 0.5%;
			}
			.date span#ur {
				margin-right: 5%;
			}
			
			.date h2 {
				margin-right: 5%;
				font-size: 100%;
				margin-bottom: 0.5%;
				}
			.date img {
				width: 25%;
				margin: 2% 5% 2% 5%;
			}
		</style>
		<script type="text/javascript">
			function UR_Start() 
			{
				UR_Nu = new Date;
				UR_Indhold = showFilled(UR_Nu.getHours()) + ":" + showFilled(UR_Nu.getMinutes());
				document.getElementById("ur").innerHTML = UR_Indhold;
				setTimeout("UR_Start()",1000);
			}
			function showFilled(Value) 
			{
				return (Value > 9) ? "" + Value : "0" + Value;
			}
		</script>
	</head>

<body onload="UR_Start()">
	<div id="content">
		<div class="destaques_tv">
			<ul>
				<? 
				/*if( count($posts) > 0) {
					foreach($posts as $post) {
						$now = date("Ymd");
						settype($now,"int");

						$meta = @get_post_meta($post->ID);
						if(array_key_exists('tv_checkbox', $meta) && $meta['tv_checkbox'][0] == 0) {
							continue;
						}
						if(array_key_exists('tv_start_date', $meta)) {
							$start_date = str_replace("-","",$meta['tv_start_date'][0]); 
							settype($start_date,"int");
							if ($now < $start_date && $start_date != 0)
								continue;
						}
						if(array_key_exists('tv_end_date', $meta)) {
							$final_date = str_replace("-","",$meta['tv_end_date'][0]); 
							settype($final_date,"int");
							if ($now > $final_date && $final_date != 0)
								continue;
						}*/ ?>
					<? if (count($show_posts) > 0) { ?>
						<? foreach ($show_posts as $post) { ?>
						<li>
							<div class="title">
								<h1><?=$post->post_title?></h1>
							</div>
							<div class="coluna01 chamada">
								<div class="thumb">
									<?=get_the_post_thumbnail($post->ID, 'thumbnail')?>
								</div>
								<? if($post->post_excerpt == "") print automatic_excerpt($post->post_content);
								else print $post->post_excerpt; ?>
							</div>
						</li>
					<? } ?>
				<? } else { ?>
					<p><?php _e(''); ?></p>
				<? } ?>
			</ul>
		</div>
		<div class="date">
			<h2>Notícias</h2>
			<span class="data">
				<?php
					$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
					$diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");
					$hoje = getdate();
					$dia = $hoje["mday"];
					$mes = $hoje["mon"];
					$nomemes = $meses[$mes];
					$ano = $hoje["year"];
					$diadasemana = $hoje["wday"];
					$nomediadasemana = $diasdasemana[$diadasemana];
					echo "$nomediadasemana, $dia de $nomemes de $ano";
				 ?>
			</span> <span id="ur"></span> <br>
			<img src="<?php bloginfo('stylesheet_directory'); ?>/page-tv/Logo_BVS_BIR_PT.png">
		</div>
	</div>
</body>
</html>
